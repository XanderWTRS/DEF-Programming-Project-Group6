<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ReservationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BanController;
use App\Http\Controllers\BezetController;
use App\Http\Controllers\ProductToevoegenController;
use App\Http\Controllers\TerugbrengenController;
use App\Http\Controllers\AddproductInventarisController;
use App\Http\Controllers\TelaatController;
use App\Models\Klaarzetten;
use App\Http\Controllers\KlaarzettenController;
use App\Http\Controllers\UsersbanController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [ProductsController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('home');

Route::get('/reservatieoverzicht', [ProductsController::class, 'index3'])
    ->middleware(['auth', 'verified'])
    ->name('reservatieoverzicht');

Route::post('/reservatieoverzicht', [ProductsController::class, 'timestamp'])
    ->middleware(['auth', 'verified'])
    ->name('timestamp');

Route::delete('/delete/{id}', [ProductsController::class, 'delete'])
    ->middleware(['auth', 'verified'])
    ->name('delete');

Route::delete('/annuleer/{id}', [ProductsController::class, 'annuleer'])
    ->middleware(['auth', 'verified'])
    ->name('annuleer');

Route::get('/admin-dashboard', [ProfileController::class,'page'])
->middleware('admin', 'auth', 'verified')->name('admin.dashboard');

Route::get('/g&v_voorwaarden', function() {
    return view('g&v_voorwaarden');
})->name('g&v_voorwaarden');

Route::get('/Banoverzicht', function () {
    return view('admin/Banoverzicht');
})->middleware('admin');

Route::get('/Banoverzicht', [BanController::class, 'index'])->middleware('admin');
Route::delete('/ban/{user_id}', [BanController::class, 'unbanStudent'])->middleware('admin');

Route::get('/Bezetscherm', [BezetController::class, 'index'])->middleware('admin');

Route::get('/Klaarzetten', function () {
    return view('Admin/Klaarzetten');
})->middleware('admin');


Route::get('/Producttoevoegen', function () {
    return view('Admin/Producttoevoegen');
})->middleware('admin');

Route::get('/Producttoevoegen', [ProductToevoegenController::class, 'index'])->middleware('admin');
Route::get('/products/filter/{category}', [ProductToevoegenController::class, 'filterByCategory'])->middleware('admin')->name('filter.products');
Route::delete('/product/{id}', [ProductToevoegenController::class, 'destroy'])->middleware('admin')->name('product.delete');
Route::patch('/product/update', [ProductToevoegenController::class, 'update'])->middleware('admin')->name('product.update');


Route::middleware('auth')->group(function () {
    Route::get('/itemlist', [ProfileController::class, 'edit2'])->name('itemlist');
});

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
Route::delete('/terugbrengen/delete/{id}', [TerugbrengenController::class, 'destroy'])->middleware('admin')->name('admin.reservation.delete');

Route::get('/Addproduct', function () {return view('admin/Addproduct');})->middleware('admin');
Route::get('/Addproduct/create', [AddproductInventarisController::class, 'create'])->middleware('admin')->name('admin.Addproduct.create');
Route::post('/Addproduct/store', [AddproductInventarisController::class, 'store'])->middleware('admin')->name('admin.Addproduct.store');




Route::get('/Klaarzetten', [KlaarzettenController::class, 'index'])->middleware('admin');
Route::get('/filter-reservations', [KlaarzettenController::class, 'filter'])->middleware('admin');
Route::post('/Klaarzetten/{id}/confirm', [KlaarzettenController::class, 'confirm'])->middleware('admin')->name('admin.Klaarzetten.confirm');



Route::get('/Telaat', function () {
    return view('A  dmin/Telaat');
})->middleware('admin');
Route::get('/Telaat', [TelaatController::class, 'index'])->middleware('admin');
Route::post('/ban', [BanController::class, 'banUser'])->name('ban')->middleware('admin');
Route::post('/unbanUser', [BanController::class, 'unbanUser'])->middleware(['auth', 'verified', 'admin'])->name('unban.user');
Route::delete('/ban/{user_id}', [BanController::class, 'unbanStudent'])->middleware('admin');


Route::get('/Users', [UsersbanController::class, 'index'])->name('gebruikersoverzicht');
Route::post('/banUser', [BanController::class, 'banUser'])->name('banUser');


  
require __DIR__.'/auth.php';
