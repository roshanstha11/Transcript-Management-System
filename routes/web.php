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
Route::post('submit-form', [FormSubmissionController::class, 'store']);
Route::get('/', [FormSubmissionController::class, 'index']);
Route::get('/create-form', [FormSubmissionController::class, 'create']);


Route::get('/edit-form/{form}', [FormSubmissionController::class, 'editForm']);
Route::put('/edit-form/{form}', [FormSubmissionController::class, 'updateForm']);
// Route::put('/students/{id}', [FormSubmissionController::class, 'update']);
Route::delete('/delete-form/{form}', [FormSubmissionController::class, 'destroy']);
