<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudentProfileController;
use App\Http\Controllers\CompanyProfileController;
use App\Http\Controllers\InternshipOfferController;
use App\Http\Controllers\ApplicationController;



Route::post(
    '/register' ,
     [AuthController::class , 'register']);

Route::post(
    '/login' , 
    [AuthController::class , 'login']);

Route::get(
    '/internship-offers',
    [InternshipOfferController::class, 'index']
);


Route::middleware('auth:sanctum')->group(function () {

    Route::post(
        '/internship-offers',
        [InternshipOfferController::class, 'store']
    );

    Route::post(
        '/applications',
        [ApplicationController::class, 'store']
    );

    Route::get(
        '/company/applications',
        [ApplicationController::class, 'companyApplications']
    );

    Route::put(
        '/applications/{id}/status',
        [ApplicationController::class, 'updateStatus']
    );

    Route::put(
        '/student-profile/{id}',
        [StudentProfileController::class, 'update']
    );

    Route::put(
        '/company-profile/{id}',
        [CompanyProfileController::class, 'update']
    );

    Route::get(
        '/my-applications',
        [ApplicationController::class, 'myApplications']
    );
});