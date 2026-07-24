<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AirlineController as AdminAirlineController;
use App\Http\Controllers\Admin\PostController as AdminPostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PolicyController;
use App\Http\Controllers\WebsiteController;
use Illuminate\Support\Facades\Route;

Route::get('/', [WebsiteController::class, 'home'])->name('home');

Route::get('/cancellation-policy', [WebsiteController::class, 'cancellationIndex'])->name('cancellation.index');
Route::get('/cancellation-policy/{airline}', [WebsiteController::class, 'cancellationShow'])->name('cancellation.show');

Route::get('/flight-change', [WebsiteController::class, 'flightChangeIndex'])->name('flight-change.index');
Route::get('/flight-change/{airline}', [WebsiteController::class, 'flightChangeShow'])->name('flight-change.show');

Route::get('/name-change', [WebsiteController::class, 'nameChangeIndex'])->name('name-change.index');
Route::get('/name-change/{airline}', [WebsiteController::class, 'nameChangeShow'])->name('name-change.show');

Route::get('/reservation-policy', [WebsiteController::class, 'reservationPolicyIndex'])->name('reservation-policy.index');
Route::get('/reservation-policy/{airline}', [WebsiteController::class, 'reservationPolicyShow'])->name('reservation-policy.show');

Route::get('/baggage-policy', [WebsiteController::class, 'baggagePolicyIndex'])->name('baggage-policy.index');
Route::get('/baggage-policy/{airline}', [WebsiteController::class, 'baggagePolicyShow'])->name('baggage-policy.show');

Route::get('/refund-policy', [WebsiteController::class, 'refundPolicyIndex'])->name('refund-policy.index');
Route::get('/refund-policy/{airline}', [WebsiteController::class, 'refundPolicyShow'])->name('refund-policy.show');

Route::get('/blog', [WebsiteController::class, 'blogIndex'])->name('blog.index');
Route::get('/blog/{slug}', [WebsiteController::class, 'blogShow'])->name('blog.show');

Route::middleware('auth')->group(function () {
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::resource('airlines', AdminAirlineController::class);
        Route::get('policies', [PolicyController::class, 'adminIndex'])->name('policies.index');
        Route::get('policies/create', [PolicyController::class, 'adminCreate'])->name('policies.create');
        Route::post('policies', [PolicyController::class, 'adminStore'])->name('policies.store');
        Route::get('policies/{policy}/edit', [PolicyController::class, 'adminEdit'])->name('policies.edit');
        Route::match(['put', 'patch'], 'policies/{policy}', [PolicyController::class, 'adminUpdate'])->name('policies.update');
        Route::delete('policies/{policy}', [PolicyController::class, 'adminDestroy'])->name('policies.destroy');
        Route::resource('posts', AdminPostController::class);
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
