<?php

use App\Http\Controllers\Apoteker\ApotekerController;
use App\Http\Controllers\Apoteker\CategoriController;
use App\Http\Controllers\Apoteker\TransaksiController;
use App\Http\Controllers\Apoteker\TransaksiItemController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Doktor\DoktorController;
use App\Http\Controllers\Services\AppointmentController;
use App\Http\Controllers\Services\PasienController;
use App\Http\Controllers\Services\ProdutJasaController;
use App\Http\Controllers\Services\ServicesController;
use App\Http\Controllers\Services\TransaksiContoller;
use App\Http\Controllers\Services\TransaksiItemServicesController;
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
        // Route::resource('/apoteker/categoriproduct', CategoriController::class);

        //transaksi pembelian
        Route::get('/apoteker/transaksi-pembelian', [TransaksiController::class, 'index'])->name('transaksi.index');
        Route::post('/apoteker/transaksi/store', [TransaksiController::class, 'store'])->name('transaksi.store');
        Route::post('/apoteker/transaksi/update', [TransaksiController::class, 'update'])->name('transaksi.update');
        // Route::get('/apoteker/')
        Route::get('/apoteker/transaksi/data', [TransaksiController::class, 'data'])->name('transaksi.data');
        Route::get('/apoteker/transaksipembelian/create/{id}', [TransaksiController::class, 'create'])->name('transaksi.create');
        Route::post('/apoteker/transaksiitem/store', [TransaksiItemController::class, 'store'])->name('transaksiitem.store');
        Route::get('/apoteker/transaksiitem/data/{id}', [TransaksiItemController::class, 'data'])->name('transaksiitem.data');
        Route::delete('/apoteker/transaksiitem/delete/{id}', [TransaksiItemController::class, 'destroy'])->name('transaksiitem.destroy');
        Route::get('/apoteker/transaksi/loadform/{id}', [TransaksiItemController::class, 'loadForm'])->name('transaksi.loadform');
    });

    Route::middleware(['doktor'])->group(function () {
        Route::get('/doktor/dashboard', [DoktorController::class, 'dashboard'])->name('doktor.index');
        Route::get('/doktor/jadwal/today', [DoktorController::class, 'jadwaltoday'])->name('jadwal.today');
        Route::get('/doktor/jadwal/today/data', [DoktorController::class, 'datatoday'])->name('data.today');
        Route::get('/doktor/jadwal/all', [DoktorController::class, 'jadwalall'])->name('jadwal.all');
        Route::get('/doktor/jadwal/all/data', [DoktorController::class, 'dataall'])->name('data.all');
        Route::get('/doktor/diagnosapasien/{id}', [DoktorController::class, 'diagnosapasien'])->name('diagnosapasien');

        Route::get('/pilihjasa', [DoktorController::class, 'pilihjasa'])->name('pilihjasa');
        Route::get('/pilihproduct', [DoktorController::class, 'pilihproduct'])->name('pilihproduct');

        //create diagnosa
        Route::get('/doktor/diagnosa/create/{id}', [DoktorController::class, 'diagnosauser'])->name('diagnosa.create');
        Route::get('/doktor/diagnosa/berlangsung/{id}', [DoktorController::class, 'berlangsung'])->name('diagnosa.berlangsung');
        Route::post('/dokter/daignosa/store', [DoktorController::class, 'storediagnosa'])->name('diagnosa.store');
    });

    Route::middleware(['services'])->group(function () {
        Route::get('/services/dashboard', [ServicesController::class, 'dashboard'])->name('services.index');
        Route::resource('/services/pasien', PasienController::class);
        Route::resource('/services/appointment', AppointmentController::class);
        Route::get('/services//all/appointment', [ServicesController::class, 'appointment_all'])->name('services.appointment_all');
        Route::get('/services/appointment/pasien/{id}', [ServicesController::class, 'getpasien'])->name('servces.getpasien');

        //jasa controller
        Route::get('/services/jasa', [ProdutJasaController::class, 'jasa'])->name('jasa.index');
        Route::post('/services/jasa/store', [ProdutJasaController::class, 'storejasa'])->name('jasa.store');
        Route::get('/services/jasa/edit/{id}', [ProdutJasaController::class, 'editjasa'])->name('jasa.edit');
        Route::put('/services/jasa/update/{id}', [ProdutJasaController::class, 'updatejasa'])->name('jasa.update');
        Route::delete('/services/jasa/delete/{id}', [ProdutJasaController::class, 'deletejasa'])->name('jasa.delete');

        Route::get('/services/transaksi-berobat', [TransaksiContoller::class, 'index'])->name('services-transaksi.index');
        Route::post('/services/transaksi/store', [TransaksiContoller::class, 'store'])->name('services-transaksi.store');
        Route::post('/services/transaksi/update', [TransaksiContoller::class, 'update'])->name('services-transaksi.update');
        Route::get('/services/transaksi/data', [TransaksiContoller::class, 'data'])->name('services-transaksi.data');
        Route::get('/services/transaksiberobat/create/{id}', [TransaksiContoller::class, 'create'])->name('services-transaksi.create');
        Route::post('/services/transaksiitem/store', [TransaksiItemServicesController::class, 'store'])->name('services-transaksiitem.store');
        Route::get('/services/transaksiitem/data/{id}', [TransaksiItemServicesController::class, 'data'])->name('services-transaksiitem.data');
        Route::get('/services/transaksiitem/datajasa/{id}', [TransaksiItemServicesController::class, 'datajasa'])->name('services-transaksiitem.datajasa');
        Route::delete('/services/transaksiitem/delete/{id}', [TransaksiItemServicesController::class, 'destroy'])->name('services-transaksiitem.destroy');
        Route::get('/services/transaksi/loadform/{id}', [TransaksiItemServicesController::class, 'loadForm'])->name('services-transaksi.loadform');
    });

    Route::get('logout', [LoginController::class, 'logout'])->name('logout');
});
