<?php

use App\Http\Controllers\Admin\AdsController;
use App\Http\Controllers\Admin\Auth\AuthController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PartnerController;
use App\Http\Controllers\Admin\QuizController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Public Routes
Route::prefix("admin")->group(function () {
    Route::post('login', [AuthController::class, 'authenticate']);
    Route::get('category/search/{title}', [CategoryController::class, 'search']);
});

Route::middleware('auth:admin')
    ->prefix("admin")
    ->group(function () {
        Route::post('logout', [AuthController::class, 'logout']);
        Route::get('user', [App\Http\Controllers\Admin\IndexController::class, 'index']);
        Route::get('profile', [App\Http\Controllers\Admin\AdminController::class, 'profile']);
        Route::put('profile', [App\Http\Controllers\Admin\AdminController::class, 'updateProfile']);
        Route::post('updatePassword', [App\Http\Controllers\Admin\AdminController::class, 'updatePassword']);
        Route::apiResource('admin', App\Http\Controllers\Admin\AdminController::class);
        Route::get('findAdmin', [App\Http\Controllers\Backend\Admin\AdminController::class, 'search']);

        // Api Resources
        Route::apiResource('category', CategoryController::class);
        Route::apiResource('partner', PartnerController::class);
        Route::apiResource('ads', AdsController::class);
        Route::apiResource('quiz', QuizController::class);

        // Common Select options
        Route::get('select-category', [CategoryController::class, 'selectCategory']);
        Route::get('select-partner', [PartnerController::class, 'selectPartner']);
    });
