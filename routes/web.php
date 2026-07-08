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

Route::get('/', [HomeController::class, 'index']);
Route::get('/cancellation-policy', [PolicyController::class, 'index'])->name('cancellation.index');
Route::get('/cancellation-policy/{airline}', [PolicyController::class, 'show'])->name('cancellation.show');
