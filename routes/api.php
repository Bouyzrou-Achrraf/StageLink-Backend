<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudentProfileController;


Route::post(
    '/register' ,
     [AuthController::class , 'register']);

Route::post(
    '/login' , 
    [AuthController::class , 'login']);

Route::put(
    'student-profile/{id}' ,
    [studentProfileController::class , 'update']
);