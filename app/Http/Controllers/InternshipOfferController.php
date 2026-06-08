<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InternshipOffer;

class InternshipOfferController extends Controller
{
    public function store(Request $request)
    {
        $user = auth()->user();

        if (!$user) {
            return response()->json(['message' => 'Not authenticated'], 401);
        }

        if ($user->role !== 'company') {
            return response()->json(['message' => 'Only companies can create offers'], 403);
        }

        $companyProfile = $user->companyProfile;

        if (!$companyProfile) {
            return response()->json(['message' => 'Company profile not found'], 403);
        }

        $data = $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'duration' => 'required|integer',
            'location' => 'nullable|string',
            'required_skills' => 'nullable|string',
            'deadline' => 'required|date',
        ]);

        $offer = \App\Models\InternshipOffer::create([
            'company_profile_id' => $companyProfile->id,
            'title' => $data['title'],
            'description' => $data['description'],
            'duration' => $data['duration'],
            'location' => $data['location'],
            'required_skills' => $data['required_skills'],
            'deadline' => $data['deadline'],
            'status' => 'open',
        ]);

        return response()->json([
            'message' => 'Offer created successfully',
            'offer' => $offer
        ], 201);
    }
}