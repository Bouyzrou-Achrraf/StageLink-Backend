<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudentProfileController;
use App\Http\Controllers\CompanyProfileController;
use App\Http\Controllers\InternshipOfferController;


Route::post(
    '/register' ,
     [AuthController::class , 'register']);

Route::post(
    '/login' , 
    [AuthController::class , 'login']);

Route::put(
    'student-profile/{id}' ,
    [StudentProfileController::class , 'update']
);

Route::put(
    'company-profile/{id}' ,
    [CompanyProfileController::class , 'update']
);



Route::post(
    '/internship-offers', 
    [InternshipOfferController::class, 'store'
]);

