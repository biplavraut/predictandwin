<?php

use App\Http\Controllers\Api\AdsController;
use App\Http\Controllers\Api\PartnerController;
use App\Http\Controllers\Api\QuizController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('register', [RegisterController::class, 'register']);
Route::post('login', [LoginController::class, 'login']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware('auth:sanctum')
    ->group(function () {
        // App Data
        Route::get('category', [CategoryController::class, 'index']);
        Route::get('partner', [PartnerController::class, 'index']);
        Route::get('quiz/{categoryId}', [QuizController::class, 'categoryQuiz']);
        Route::get('quiz', [QuizController::class, 'index']);
        Route::get('ads', [AdsController::class, 'index']);
        Route::post('answer', [QuizController::class, 'answer']);
        // User
        Route::get('profile', [ProfileController::class, 'index']);
        Route::get('logout', [LoginController::class, 'logout']);
    });
