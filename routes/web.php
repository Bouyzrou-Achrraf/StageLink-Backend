<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\InternshipOfferController;
use App\Http\Controllers\ApplicationController;
use Laravel\Sanctum\PersonalAccessToken;

/*
|---------------------------------------
| TEST PAGES (BLADE)
|---------------------------------------
*/

Route::get('/test-register', fn() => view('test-register'));
Route::get('/test-login', fn() => view('test-login'));
Route::get('/test-offer', fn() => view('test-offer'));
Route::get('/test-application', fn() => view('test-application'));

/*
|---------------------------------------
| AUTH (BLADE TEST)
|---------------------------------------
*/
Route::post('/test-login', [AuthController::class, 'login']);
Route::post('/test-register', [AuthController::class, 'register']);

/*
|---------------------------------------
| OFFER TEST (TOKEN MANUAL)
|---------------------------------------
*/
Route::post('/test-offer', function (Request $request) {

    $token = $request->input('token');

    $accessToken = PersonalAccessToken::findToken($token);

    if (!$accessToken) {
        return response()->json(['message' => 'Invalid token'], 401);
    }

    $user = $accessToken->tokenable;

    if ($user->role !== 'company') {
        return response()->json(['message' => 'Only company can create offers'], 403);
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
        'company_profile_id' => $user->companyProfile->id,
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
    ]);
});

/*
|---------------------------------------
| APPLICATION TEST
|---------------------------------------
*/
Route::post('/test-application', function (Request $request) {

    $token = $request->input('token');

    $accessToken = PersonalAccessToken::findToken($token);

    if (!$accessToken) {
        return response()->json(['message' => 'Invalid token'], 401);
    }

    $user = $accessToken->tokenable;

    if ($user->role !== 'student') {
        return response()->json(['message' => 'Only students can apply'], 403);
    }

    $studentProfile = $user->studentProfile;

    $offer = \App\Models\InternshipOffer::find($request->internship_offer_id);

    if (!$offer) {
        return response()->json(['message' => 'Offer not found'], 404);
    }

    $exists = \App\Models\Application::where('student_profile_id', $studentProfile->id)
        ->where('internship_offer_id', $offer->id)
        ->exists();

    if ($exists) {
        return response()->json(['message' => 'Already applied'], 409);
    }

    $application = \App\Models\Application::create([
        'student_profile_id' => $studentProfile->id,
        'internship_offer_id' => $offer->id,
        'status' => 'pending'
    ]);

    return response()->json([
        'message' => 'Application successful',
        'application' => $application
    ]);
});

Route::get('/test-offers-list', function () {
    return view('test-offers-list');
});

Route::post('/test-offers-list', function () {

    $offers = \App\Models\InternshipOffer::with('companyProfile')->get();

    return response()->json([
        'offers' => $offers
    ]);
});

Route::get('/test-company-applications', function () {
    return view('test-company-applications');
});

Route::post('/test-company-applications', function (Illuminate\Http\Request $request) {

    $token = $request->token;

    $accessToken = PersonalAccessToken::findToken($token);

    if (!$accessToken) {
        return response()->json([
            'message' => 'Invalid token'
        ], 401);
    }

    $user = $accessToken->tokenable;

    if ($user->role !== 'company') {
        return response()->json([
            'message' => 'Only companies can view applications'
        ], 403);
    }

    $applications = \App\Models\Application::with([
        'studentProfile',
        'internshipOffer'
    ])
    ->whereHas('internshipOffer', function ($query) use ($user) {
        $query->where(
            'company_profile_id',
            $user->companyProfile->id
        );
    })
    ->get();

    return response()->json([
        'applications' => $applications
    ]);
});

Route::get('/test-update-application', function () {
    return view('test-update-application');
});

Route::post('/test-update-application', function (Illuminate\Http\Request $request) {

    $token = trim($request->token);

    $accessToken = \Laravel\Sanctum\PersonalAccessToken::findToken($token);

    if (!$accessToken) {
        return response()->json([
            'message' => 'Invalid token'
        ], 401);
    }

    $user = $accessToken->tokenable;

    if ($user->role !== 'company') {
        return response()->json([
            'message' => 'Only companies can manage applications'
        ], 403);
    }

    $application = \App\Models\Application::find(
        $request->application_id
    );

    if (!$application) {
        return response()->json([
            'message' => 'Application not found'
        ], 404);
    }

    $application->status = $request->status;

    $application->save();

    return response()->json([
        'message' => 'Application updated successfully',
        'application' => $application
    ]);
});

Route::get('/test-my-applications', function () {
    return view('test-my-applications');
});





Route::post('/test-my-applications', function (Illuminate\Http\Request $request) {

    $accessToken = PersonalAccessToken::findToken(
        trim($request->token)
    );

    if (!$accessToken) {
        return response()->json([
            'message' => 'Invalid token'
        ], 401);
    }

    $user = $accessToken->tokenable;

    if ($user->role !== 'student') {
        return response()->json([
            'message' => 'Only students can view applications'
        ], 403);
    }

    $studentProfile = $user->studentProfile;

    $applications = \App\Models\Application::with(
        'internshipOffer'
    )
    ->where(
        'student_profile_id',
        $studentProfile->id
    )
    ->get();

    return response()->json([
        'applications' => $applications
    ]);
});