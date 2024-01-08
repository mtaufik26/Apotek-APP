<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/login', function() {
    return view('login');
})->name('login');
Route::post('/login', [UserController::class, 'loginAuth'])->name('login.auth');
Route::get('/logout', [UserController::class, 'logout'])->name('logout');

Route::get('/error-permission', function(){
    return view('errors.permission');
})->name('error.permision');

Route::middleware(['IsLogin'])->group(function() {
    Route::get('/home', function () {
        return view('home');
    })->name('home.page');
});

Route::middleware(['IsLogin', 'IsAdmin'])->group(function(){
    Route::get('/home', function () {
        return view('home');
    })->name('home.page');

Route::prefix('/medicine')->name('medicine.')->group(function () {
    Route::get('/create', [MedicineController::class, 'create'])->name('create');
    Route::post('/store', [MedicineController::class, 'store'])->name('store');
    Route::get('/', [MedicineController::class, 'index'])->name('home');
    Route::get('/{id}', [MedicineController::class, 'edit'])->name('edit');
    
    Route::patch('/{id}', [MedicineController::class, 'update'])->name('update');
    Route::delete('/{id}', [MedicineController::class, 'destroy'])->name('delete');
    Route::get('/data/stock', [MedicineController::class, 'stock'])->name('stock');
    Route::get('/data/stock/{id}', [MedicineController::class, 'stockEdit'])->name('stock.edit');
    Route::patch('/data/stock/{id}', [MedicineController::class, 'stockUpdate'])->name('stock.update');
});

Route::prefix('/user')->name('user.')->group(function () {
    Route::get('/create', [UserController::class, 'create'])->name('create');
    Route::post('/store', [UserController::class, 'store'])->name('store');
    Route::get('/', [UserController::class, 'index'])->name('index');
    Route::get('/{id}', [UserController::class, 'edit'])->name('edit');
    
    Route::patch('/{id}', [UserController::class, 'update'])->name('update');
    Route::delete('/{id}', [UserController::class, 'destroy'])->name('delete');
    Route::get('/data/stock', [UserController::class, 'stock'])->name('stock');
    Route::get('/data/stock/{id}', [UserController::class, 'stockEdit'])->name('stock.edit');
    Route::patch('/data/stock/{id}', [UserController::class, 'stockUpdate'])->name('stock.update');
});

// Route::prefix('/user')->name('user.')->group(function () {
//     Route::get('/create', [UserController::class, 'create'])->name('create');
//     Route::post('/daftar', [UserController::class, 'daftar'])->name('daftar');
// });

Route::middleware(['IsLogin', 'IsKasir'])->group(function() {
    Route::prefix('/kasir')->name('kasir.')->group(function() {
        Route::get('/home', function () {
            return view('welcome');
        })->name('home');
    });
});
});