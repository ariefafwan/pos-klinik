<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::middleware(['apoteker'])->group(function () {
        Route::get('/admin/test', [ProductController::class, 'test'])->name('product.test');
        Route::get('/admin/data', [ProductController::class, 'data'])->name('test.data');
        Route::post('/admin/store', [ProductController::class, 'store'])->name('test.store');
        Route::post('/admin/update/{id}', [ProductController::class, 'update'])->name('test.update');
    });

    Route::middleware(['doktor'])->group(function () {
    });

    Route::middleware(['services'])->group(function () {
    });

    Route::get('logout', [LoginController::class, 'logout'])->name('logout');
});
