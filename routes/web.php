<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InternshipOfferController;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test-register', function () {
    return view('test-register');
});

Route::get('/test-login', function () {
    return view('test-login');
});


Route::get('/test-offer', function () {
    return view('test-offer');
});

Route::post('/test-internship-offer', [InternshipOfferController::class, 'store']);