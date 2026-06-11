<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Application;
use App\Models\InternshipOffer;

class ApplicationController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'internship_offer_id' => 'required|integer'
        ]);

        $user = auth()->user();

        if (!$user) {
            return response()->json(['message' => 'Not authenticated'], 401);
        }

        if ($user->role !== 'student') {
            return response()->json(['message' => 'Only students can apply'], 403);
        }

        $studentProfile = $user->studentProfile;

        if (!$studentProfile) {
            return response()->json(['message' => 'Student profile not found'], 403);
        }

        $offer = InternshipOffer::find($validated['internship_offer_id']);

        if (!$offer) {
            return response()->json(['message' => 'Offer not found'], 404);
        }

        $exists = Application::where('student_profile_id', $studentProfile->id)
            ->where('internship_offer_id', $offer->id)
            ->exists();

        if ($exists) {
            return response()->json(['message' => 'Already applied'], 409);
        }

        $application = Application::create([
            'student_profile_id' => $studentProfile->id,
            'internship_offer_id' => $offer->id,
            'status' => 'pending'
        ]);

        return response()->json([
            'message' => 'Application created',
            'application' => $application
        ]);
    }


    public function companyApplications()
    {
        $user = auth()->user();

        if (!$user) {
            return response()->json([
                'message' => 'Not authenticated'
            ], 401);
        }

        if ($user->role !== 'company') {
            return response()->json([
                'message' => 'Only companies can view applications'
            ], 403);
        }

        $companyProfile = $user->companyProfile;

        $applications = \App\Models\Application::with([
            'studentProfile',
            'internshipOffer'
        ])
        ->whereHas('internshipOffer', function ($query) use ($companyProfile) {
            $query->where(
                'company_profile_id',
                $companyProfile->id
            );
        })
        ->get();

        return response()->json([
            'applications' => $applications
        ]);
    }
    public function updateStatus(Request $request, $id)
    {
        dd('UPDATE STATUS WORKS', $id, $request->all());

        $validated = $request->validate([
            'status' => 'required|in:accepted,rejected'
        ]);

        $application = Application::find($id);

        if (!$application) {
            return response()->json(['message' => 'Application not found'], 404);
        }

        $application->status = $validated['status'];
        $application->save();

        return response()->json([
            'message' => 'Status updated',
            'application' => $application
        ]);
    } 
    public function myApplications()
{
    $user = auth()->user();

    if (!$user) {
        return response()->json([
            'message' => 'Not authenticated'
        ], 401);
    }

    if ($user->role !== 'student') {
        return response()->json([
            'message' => 'Only students can view applications'
        ], 403);
    }

    $studentProfile = $user->studentProfile;

    if (!$studentProfile) {
        return response()->json([
            'message' => 'Student profile not found'
        ], 404);
    }

    $applications = Application::with('internshipOffer')
        ->where('student_profile_id', $studentProfile->id)
        ->get();

    return response()->json([
        'applications' => $applications
    ]);
}
}