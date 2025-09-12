<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormSubmissionController;
use App\Http\Controllers\ImportExportController;


// // Form Submission Route
Route::post('submit-form', [FormSubmissionController::class, 'store'])->name('submit-form');
Route::get('/', [FormSubmissionController::class, 'index']);
Route::get('/create-form', [FormSubmissionController::class, 'create'])->name('create-form');
Route::get('/edit-form/{form}', [FormSubmissionController::class, 'editForm'])->name('edit-form');
Route::put('/edit-form/{form}', [FormSubmissionController::class, 'updateForm'])->name('update-form');
Route::delete('/delete-form/{form}', [FormSubmissionController::class, 'destroy'])->name('delete-form');


// Import Export Routes
Route::get('/export-record', [ImportExportController::class, 'export'])->name('export-record');
Route::POST('/import-record', [ImportExportController::class, 'import'])->name('import-record');
