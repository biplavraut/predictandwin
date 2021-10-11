<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/backend/{path?}', function () {
    return view('backend.dashboard');
})->name('dashboard')->where('path', '([A-z\/_.\d-]+)?');

// Route::get('/backend/{path?}', [App\Http\Controllers\Admin\IndexController::class, 'index'])->name('dashboard')->where('path', '([A-z\/_.\d-]+)?');

Route::view('home', 'frontend.home')->middleware('auth');
