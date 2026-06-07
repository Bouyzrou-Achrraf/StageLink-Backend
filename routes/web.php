<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test-register', function () {
    return view('test-register');
});

Route::get('/test-login', function () {
    return view('test-login');
});