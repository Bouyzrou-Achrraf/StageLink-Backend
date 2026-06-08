<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InternshipOffer;

class InternshipOfferController extends Controller
{
    public function store(Request $request)
{
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'duration' => 'required|integer|min:1|max:12',
        'location' => 'nullable|string|max:255',
        'required_skills' => 'nullable|string',
        'deadline' => 'required|date',
    ]);

    try {
        $offer = \App\Models\InternshipOffer::create([
            'company_profile_id' => 1 ,
            'title' => $validated['title'],
            'description' => $validated['description'],
            'duration' => $validated['duration'],
            'location' => $validated['location'],
            'required_skills' => $validated['required_skills'],
            'deadline' => $validated['deadline'],
            'status' => 'open',
        ]);

        dd("CREATED", $offer);

    } catch (\Exception $e) {
        dd("ERROR", $e->getMessage());
    }
}
}