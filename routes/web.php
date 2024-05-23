<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ReservationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BanController;
use App\Http\Controllers\BezetController;
use App\Http\Controllers\ProductToevoegenController;
use App\Http\Controllers\TerugbrengenController;

Route::get('/', function () {
    return view('welcome'); 
});

Route::get('/home', [ProductsController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('home');

Route::get('/reservatieoverzicht', [ProductsController::class, 'index3'])
    ->middleware(['auth', 'verified'])
    ->name('reservatieoverzicht');

Route::delete('/delete/{id}', [ProductsController::class, 'delete'])
    ->middleware(['auth', 'verified'])
    ->name('delete');

Route::get('/admin-dashboard', [ProfileController::class,'page'])
->middleware('admin', 'auth', 'verified')->name('admin.dashboard');

Route::get('/winkelmand', function() {
    return view('winkelmand');
})->middleware(['auth', 'verified'])->name('winkelmand');

Route::get('/g&v_voorwaarden', function() {
    return view('g&v_voorwaarden');
})->name('g&v_voorwaarden');

Route::get('/Banoverzicht', function () {
    return view('admin/Banoverzicht');
});

Route::get('/Banoverzicht', [BanController::class, 'index']);
Route::delete('/ban/{id}', [BanController::class, 'unbanStudent']);

Route::get('/Bezetscherm', [BezetController::class, 'index']);

Route::get('/Klaarzetten', function () {
    return view('Admin/Klaarzetten');
});


Route::get('/Producttoevoegen', function () {
    return view('Admin/Producttoevoegen');
});

Route::get('/Producttoevoegen', [ProductToevoegenController::class, 'index']);
Route::get('/products/filter/{category}', [ProductToevoegenController::class, 'filterByCategory'])->name('filter.products');
Route::delete('/product/{id}', [ProductToevoegenController::class, 'destroy'])->name('product.delete');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/product/{id}', [ReservationController::class, 'show']);
Route::post('/product/{id}', [ReservationController::class, 'store']);

Route::get('/terugbrengen', [TerugbrengenController::class, 'index'])->middleware('admin')->name('admin.terugbrengen.index');
Route::get('/terugbrengen/search', [TerugbrengenController::class, 'search'])->middleware('admin')->name('admin.terugbrengen.search');
Route::post('/terugbrengen/search', [TerugbrengenController::class, 'search'])->middleware('admin');



require __DIR__.'/auth.php';
