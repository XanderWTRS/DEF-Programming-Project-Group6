<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ReservationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [ProductsController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('home');

Route::get('/admin-dashboard', function () {
    return view('adminDashboard');
})->middleware(['auth', 'verified'])->name('admin.dashboard');

Route::get('/winkelmand', function() {
    return view('winkelmand');
})->middleware(['auth', 'verified'])->name('winkelmand');

Route::get('/g&v_voorwaarden', function() {
    return view('g&v_voorwaarden');
})->name('g&v_voorwaarden');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/product/{id}', [ReservationController::class, 'show']);
Route::post('/product/{id}', [ReservationController::class, 'store']);


require __DIR__.'/auth.php';
