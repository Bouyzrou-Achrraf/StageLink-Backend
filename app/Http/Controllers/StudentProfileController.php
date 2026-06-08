<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudentProfile;

class StudentProfileController extends Controller
{
    public function update(Request $request , $id) {
         $validated = $request->validate([
            'phone' => 'nullable|string|max:20',
            'city' => 'nullable|string|max:100',
            'field_of_study' => 'nullable|string|max:255',
            'education_level' => 'nullable|string|max:255',
            'skills' => 'nullable|string',
            'bio' => 'nullable|string|max:1000',
        ]);

        $profile = StudentProfile::where('id', $id)
            ->where('user_id', auth()->id())
            ->first();

        if (!$profile) {
            return response()->json([
                'message' => 'Student profile not found'
            ], 404);
        }

        $profile->update($validated);

        return response()->json([
            'message' => 'Profile updated successfully',
            'profile' => $profile
        ], 200);
    }

}

