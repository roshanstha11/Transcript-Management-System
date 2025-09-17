<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormSubmissionController;
use App\Http\Controllers\ImportExportController;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\RoleMiddleware;

// GUEST ROUTES
// Accessible only by users who are NOT logged in.
// We can optionally group them in a 'guest' middleware.
Route::get('/', function () {
    if (Auth::check()) {
        switch (Auth::user()->role) {
            case 'admin':
            case 'user':
            case 'super_admin':
                return redirect()->route('show-form')->with('error', 'You are already logged in.');
        }
    }

    return redirect()->route('login');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])
    ->middleware('guest')
    ->name('login');

Route::middleware(['guest'])->group(function () {

    // Redirect "/" to "/login"
    // Route::get('/', function () {
    //     return redirect()->route('login');
    // });

    // Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AuthController::class, 'login'])->name('login.post');

});

// PROTECTED ROUTES (AUTHENTICATED USERS)
// Accessible only by users who ARE logged in.
Route::middleware(['role:user,admin,super_admin'])->group(function () {
    
    Route::get('/show-form', [FormSubmissionController::class, 'index'])->name('show-form');
    Route::post('submit-form', [FormSubmissionController::class, 'store'])->name('submit-form');
    Route::get('/create-form', [FormSubmissionController::class, 'create'])->name('create-form');
    
});
Route::middleware(['role:admin,super_admin'])->group(function () {
    
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    
    // // Form Submission Route
    Route::get('/edit-form/{id}', [FormSubmissionController::class, 'editForm'])->name('edit-form');
    Route::put('/edit-form/{id}', [FormSubmissionController::class, 'updateForm'])->name('update-form');
    Route::delete('/delete-form/{id}', [FormSubmissionController::class, 'destroy'])->name('delete-form');
    
    Route::post('/check-transcript', [FormSubmissionController::class, 'checkTranscript'])->name('check.transcript');
    Route::post('/check-registration', [FormSubmissionController::class, 'checkRegistration'])->name('check.registration');
    
    // Import Export Routes
    Route::get('/export-record', [ImportExportController::class, 'export'])->name('export-record');
    Route::POST('/import-record', [ImportExportController::class, 'import'])->name('import-record');
    
    Route::get('register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('register', [AuthController::class, 'register']);
});


