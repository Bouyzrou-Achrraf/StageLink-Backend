<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudentProfileController;
use App\Http\Controllers\CompanyProfileController;


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