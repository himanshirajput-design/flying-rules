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

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PolicyController;
use App\Http\Controllers\FlightChangeController;

Route::get('/', [HomeController::class, 'index'])->name('home');

// Cancellation Policy Routes
Route::get('/cancellation-policy', [PolicyController::class, 'index'])->name('cancellation.index');
Route::get('/cancellation-policy/{airline}', [PolicyController::class, 'show'])->name('cancellation.show');

// Flight Change Policy Routes
Route::get('/flight-change', [FlightChangeController::class, 'index'])->name('flight-change.index');
Route::get('/flight-change/{airline}', [FlightChangeController::class, 'show'])->name('flight-change.show');
