<?php

use App\Http\Controllers\Apoteker\ApotekerController;
use App\Http\Controllers\Apoteker\CategoriController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Doktor\DoktorController;
use App\Http\Controllers\Services\AppointmentController;
use App\Http\Controllers\Services\PasienController;
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

        //data product resource
        Route::get('/apoteker/product/data', [ApotekerController::class, 'data'])->name('product.data');

        //product controller
        Route::get('/apoteker/product', [ApotekerController::class, 'product'])->name('product.index');
        Route::post('/apoteker/product/store', [ApotekerController::class, 'storeproduct'])->name('product.store');
        Route::get('/apoteker/product/edit/{id}', [ApotekerController::class, 'editproduct'])->name('product.edit');
        Route::put('/apoteker/product/update/{id}', [ApotekerController::class, 'updateproduct'])->name('product.update');
        Route::delete('/apoteker/product/delete/{id}', [ApotekerController::class, 'deleteproduct'])->name('product.delete');

        //categori Product
        Route::resource('/apoteker/categoriproduct', CategoriController::class);
    });

    Route::middleware(['doktor'])->group(function () {
        Route::get('/doktor/dashboard', [DoktorController::class, 'dashboard'])->name('doktor.index');
        Route::get('/doktor/jadwal/today', [DoktorController::class, 'jadwaltoday'])->name('jadwal.today');
        Route::get('/doktor/jadwal/today/data', [DoktorController::class, 'datatoday'])->name('data.today');
        Route::get('/doktor/jadwal/all', [DoktorController::class, 'jadwalall'])->name('jadwal.all');
        Route::get('/doktor/jadwal/all/data', [DoktorController::class, 'dataall'])->name('data.all');

        //create diagnosa
        Route::get('/doktor/diagnosa/create/{id}', [DoktorController::class, 'diagnosauser'])->name('diagnosa.create');
        Route::get('/doktor/diagnosa/berlangsung/{id}', [DoktorController::class, 'berlangsung'])->name('diagnosa.berlangsung');
        Route::post('/dokter/daignosa/store', [DoktorController::class, 'storediagnosa'])->name('diagnosa.store');
    });

    Route::middleware(['services'])->group(function () {
        Route::get('/services/dashboard', [ServicesController::class, 'dashboard'])->name('services.index');
        Route::resource('/services/pasien', PasienController::class);
        Route::resource('/services/appointment', AppointmentController::class);
        Route::get('/services/appointment/pasien/{id}', [ServicesController::class, 'getpasien'])->name('servces.getpasien');
    });

    Route::get('logout', [LoginController::class, 'logout'])->name('logout');
});
