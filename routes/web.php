<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('home');
})->middleware(['auth', 'verified'])->name('home');

Route::get('/admin-dashboard', function () {
    return view('adminDashboard');
})->middleware(['auth', 'verified'])->name('admin.dashboard');

Route::get('/winkelmand', function() {
    return view('winkelmand');
})->middleware(['auth', 'verified'])->name('winkelmand');
