<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormSubmissionController;

// Route::get('/', function () {
//     return view('index');
// });

// Route::get('/create-form', function () {
//     return view('formSubmissions.create');
// });


// // Form Submission Route
Route::post('submit-form', [FormSubmissionController::class, 'store'])->name('form.submit');
Route::get('/', [FormSubmissionController::class, 'index']);
Route::get('/create-form', [FormSubmissionController::class, 'create']);


Route::get('/formSubmissions/{id}/edit', [FormSubmissionController::class, 'edit']);
// Route::put('/students/{id}', [FormSubmissionController::class, 'update']);
Route::delete('/formSubmissions/{id}', [FormSubmissionController::class, 'destroy']);
