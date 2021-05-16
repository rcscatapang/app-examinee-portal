<?php

use App\Http\Controllers\Instructor;
use App\Http\Controllers\Student;
use Illuminate\Support\Facades\Auth;
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

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::name('instructor.')->prefix('instructor')->middleware(['web.instructor'])->group(function () {

    // Dashboard
    Route::get('dashboard', Instructor\DashboardController::class);
});

Route::middleware(['web.student'])->group(function () {

    // Dashboard
    Route::get('dashboard', Student\DashboardController::class);
});
