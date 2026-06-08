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
}