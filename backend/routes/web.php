<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmployeeController;

Route::get('/', function () {
    if (auth()->check() && auth()->user()->isAdmin()) {
        $users = \App\Models\User::orderBy('created_at', 'desc')->get();
        return view('users', compact('users'));
    }

    return view('welcome');
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);

// Simple frontend pages
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::get('/users', function () {
    if (!auth()->check() || !auth()->user()->isAdmin()) {
        abort(403, 'Access denied. Admin access required.');
    }

    $users = \App\Models\User::orderBy('created_at', 'desc')->get();
    return view('users', compact('users'));
})->name('users');

Route::resource('employees', EmployeeController::class);
