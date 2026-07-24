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
use App\Http\Controllers\NameChangeController;
use App\Http\Controllers\ReservationPolicyController;
use App\Http\Controllers\BaggagePolicyController;
use App\Http\Controllers\RefundPolicyController;
use App\Http\Controllers\BlogController;

Route::get('/', [HomeController::class, 'index'])->name('home');

// Cancellation Policy Routes
Route::get('/cancellation-policy', [PolicyController::class, 'index'])->name('cancellation.index');
Route::get('/cancellation-policy/{airline}', [PolicyController::class, 'show'])->name('cancellation.show');

// Flight Change Policy Routes
Route::get('/flight-change', [FlightChangeController::class, 'index'])->name('flight-change.index');
Route::get('/flight-change/{airline}', [FlightChangeController::class, 'show'])->name('flight-change.show');

// Name Change Policy Routes
Route::get('/name-change', [NameChangeController::class, 'index'])->name('name-change.index');
Route::get('/name-change/{airline}', [NameChangeController::class, 'show'])->name('name-change.show');

// Reservation Policy Routes
Route::get('/reservation-policy', [ReservationPolicyController::class, 'index'])->name('reservation-policy.index');
Route::get('/reservation-policy/{airline}', [ReservationPolicyController::class, 'show'])->name('reservation-policy.show');

// Baggage Policy Routes
Route::get('/baggage-policy', [BaggagePolicyController::class, 'index'])->name('baggage-policy.index');
Route::get('/baggage-policy/{airline}', [BaggagePolicyController::class, 'show'])->name('baggage-policy.show');

// Refund Policy Routes
Route::get('/refund-policy', [RefundPolicyController::class, 'index'])->name('refund-policy.index');
Route::get('/refund-policy/{airline}', [RefundPolicyController::class, 'show'])->name('refund-policy.show');

// Blog Routes
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');

// Admin Routes
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AirlineController as AdminAirlineController;
use App\Http\Controllers\Admin\PolicyController as AdminPolicyController;
use App\Http\Controllers\Admin\PostController as AdminPostController;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::resource('airlines', AdminAirlineController::class);
    Route::resource('policies', AdminPolicyController::class);
    Route::resource('posts', AdminPostController::class);
});
