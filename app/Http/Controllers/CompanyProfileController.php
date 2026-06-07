<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CompanyProfile;

class CompanyProfileController extends Controller
{
    public function update(Request $request , $id){
        $validated = $request->validate([
            'sector' => 'nullable|string|max:255' ,
            'city' => 'nullable|string|max:100' ,
            'website' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:1000' ,
            'logo' => 'nullable|url|max:255'

        ]);

         $profile = CompanyProfile::find($id);

        if (!$profile) {
            return response()->json([
                'message' => 'company profile not found'
            ], 404);
        }

        $profile->update($validated);

        return response()->json([
            'message' => 'Profile updated successfully',
            'profile' => $profile
        ], 200);
    }
}
