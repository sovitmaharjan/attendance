<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/demo', function () {
    return view('demo');
})->name('demo');

Route::get('/', function () {
    return auth()->user() ? redirect('dashboard') : view('auth.login');
});

Route::get('/login', function () {
    return auth()->user() ? redirect('dashboard') : view('auth.login');
})->name('login');

Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::group([
    'middleware' => [
        'auth'
    ]
], function () {
    Route::get('/dashboard', function () {
        return view('demo');
    })->name('dashboard');
});
