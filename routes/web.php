<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormSubmissionController;
use App\Http\Controllers\ImportExportController;
use App\Http\Controllers\AuthController;


// // Form Submission Route
Route::post('submit-form', [FormSubmissionController::class, 'store'])->name('submit-form');
Route::get('/', [FormSubmissionController::class, 'index'])->name('index');
Route::get('/create-form', [FormSubmissionController::class, 'create'])->name('create-form');
Route::get('/edit-form/{id}', [FormSubmissionController::class, 'editForm'])->name('edit-form');
Route::put('/edit-form/{id}', [FormSubmissionController::class, 'updateForm'])->name('update-form');
Route::delete('/delete-form/{id}', [FormSubmissionController::class, 'destroy'])->name('delete-form');

Route::post('/check-transcript', [FormSubmissionController::class, 'checkTranscript'])->name('check.transcript');
Route::post('/check-registration', [FormSubmissionController::class, 'checkRegistration'])->name('check.registration');



// Import Export Routes
Route::get('/export-record', [ImportExportController::class, 'export'])->name('export-record');
Route::POST('/import-record', [ImportExportController::class, 'import'])->name('import-record');


// Authentication Routes
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login-form');
Route::post('login', [AuthController::class, 'login'])->name('login');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('register', [AuthController::class, 'showRegisterForm'])->name('register-form');
Route::post('register', [AuthController::class, 'register'])->name('register');

// Protected Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return "Welcome, " . auth()->user()->name;
    });
});

