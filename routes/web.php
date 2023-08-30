<?php

use App\Http\Controllers\Apoteker\ApotekerController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Doktor\DoktorController;
use App\Http\Controllers\Services\ServicesController;
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
        Route::get('/apoteker/dashboard', [ApotekerController::class, 'dashboard'])->name('apoteker.index');
        // Route::get('/admin/test', [ProductController::class, 'test'])->name('product.test');
        // Route::get('/admin/data', [ProductController::class, 'data'])->name('test.data');
        // Route::post('/admin/store', [ProductController::class, 'store'])->name('test.store');
        // Route::post('/admin/update/{id}', [ProductController::class, 'update'])->name('test.update');
    });

    Route::middleware(['doktor'])->group(function () {
        Route::get('/doktor/dashboard', [DoktorController::class, 'dashboard'])->name('doktor.index');
    });

    Route::middleware(['services'])->group(function () {
        Route::get('/services/dashboard', [ServicesController::class, 'dashboard'])->name('services.index');
    });

    Route::get('logout', [LoginController::class, 'logout'])->name('logout');
});
