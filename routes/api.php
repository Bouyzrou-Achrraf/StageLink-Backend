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


Route::middleware('auth:sanctum')->group(function () {

    Route::post(
        '/internship-offers',
        [InternshipOfferController::class, 'store']);

    Route::post(
        '/applications',
        [ApplicationController::class, 'store']);

    Route::put(
        'student-profile/{id}' ,
        [StudentProfileController::class , 'update']
    );

    Route::put(
        'company-profile/{id}' ,
        [CompanyProfileController::class , 'update']
    );

});