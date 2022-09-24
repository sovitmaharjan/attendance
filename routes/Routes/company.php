<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PermissionGroupController;

Route::controller(CompanyController::class)->middleware('auth')->group(function(){

    

    Route::resource('/company', CompanyController::class);
    // Route::resource('/branch', CompanyController::class);
    // Route::resource('/department', CompanyController::class);
    // Route::resource('/designation', CompanyController::class);
    
});

