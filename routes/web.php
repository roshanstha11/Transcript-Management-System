<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});
Route::get('/trancript', function () {
    return view('transcript');
});
Route::get('/registration', function () {
    return view('registration');
});
Route::get('/schools', function () {
    return view('schools');
});
Route::get('/child', function () {
    return view('child');
});
