<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudentLeaveController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/login/admin', function () {
    return view('auth.login', ['role' => 'admin']);
})->name('login.admin');

Route::get('/login/student', function () {
    return view('auth.login', ['role' => 'student']);
})->name('login.student');

Route::get('/register', function () {
    return view('register');
})->name('register');

Route::post('/register', [RegisterController::class, 'register'])->name('register.post');

Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::get('/admin/dashboard', [LoginController::class, 'dashboard'])->name('admin.dashboard');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/student/dashboard', [StudentController::class, 'dashboard'])->name('student.dashboard');
    Route::post('/student/leave-request', [StudentController::class, 'leaveRequest'])->name('student.leave.request');
    Route::get('/profile/edit', [StudentController::class, 'editProfile'])->name('profile.edit');
    Route::put('/profile/update', [StudentController::class, 'updateProfile'])->name('profile.update');
    Route::post('/student/leave-request', [StudentLeaveController::class, 'submit'])->name('student.leave.submit');
});
