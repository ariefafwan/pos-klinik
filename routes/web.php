<?php

use App\Http\Controllers\Apoteker\ApotekerController;
use App\Http\Controllers\Apoteker\CategoriController;
use App\Http\Controllers\Apoteker\TransaksiController;
use App\Http\Controllers\Apoteker\TransaksiItemController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Doktor\DoktorController;
use App\Http\Controllers\Owner\AppointmentOwnerController;
use App\Http\Controllers\Owner\OwnerController;
use App\Http\Controllers\Owner\PasienOwnerController;
use App\Http\Controllers\Owner\ProductJasaOwnerController;
use App\Http\Controllers\Owner\TransaksiItemJasaOwnerController;
use App\Http\Controllers\Owner\TransaksiItemOwnerController;
use App\Http\Controllers\Owner\TransaksiJasaOwnerController;
use App\Http\Controllers\Owner\TransaksiOwnerController;
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
    return redirect()->route('login');
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
        Route::get('/doktor/diagnosapasien/{id}', [DoktorController::class, 'diagnosapasien'])->name('doktor.diagnosapasien');

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
        Route::get('/services/diagnosapasien/{id}', [DoktorController::class, 'diagnosapasien'])->name('services.diagnosapasien');
        Route::resource('/services/appointment', AppointmentController::class);
        Route::get('/services/all/appointment', [ServicesController::class, 'appointment_all'])->name('services.appointment_all');
        // Route::get('/services/appointment/pasien/{id}', [ServicesController::class, 'getpasien'])->name('services.getpasien');

        //jasa controller
        Route::get('/services/jasa', [ProdutJasaController::class, 'jasa'])->name('jasa.index');
        Route::post('/services/jasa/store', [ProdutJasaController::class, 'storejasa'])->name('jasa.store');
        Route::get('/services/jasa/edit/{id}', [ProdutJasaController::class, 'editjasa'])->name('jasa.edit');
        Route::put('/services/jasa/update/{id}', [ProdutJasaController::class, 'updatejasa'])->name('jasa.update');
        Route::delete('/services/jasa/delete/{id}', [ProdutJasaController::class, 'deletejasa'])->name('jasa.delete');

        Route::get('/services/transaksi-berobat', [TransaksiContoller::class, 'index'])->name('services-transaksi.index');
        // Route::post('/services/transaksi/store', [TransaksiContoller::class, 'store'])->name('services-transaksi.store');
        Route::post('/services/transaksi/update', [TransaksiContoller::class, 'update'])->name('services-transaksi.update');
        Route::get('/services/transaksi/data', [TransaksiContoller::class, 'data'])->name('services-transaksi.data');
        Route::get('/services/transaksiberobat/create/{id}', [TransaksiContoller::class, 'create'])->name('services-transaksi.create');
        Route::post('/services/transaksiitem/store', [TransaksiItemServicesController::class, 'store'])->name('services-transaksiitem.store');
        Route::get('/services/transaksiitem/data/{id}', [TransaksiItemServicesController::class, 'data'])->name('services-transaksiitem.data');
        Route::get('/services/transaksiitem/datajasa/{id}', [TransaksiItemServicesController::class, 'datajasa'])->name('services-transaksiitem.datajasa');
        Route::delete('/services/transaksiitem/delete/{id}', [TransaksiItemServicesController::class, 'destroy'])->name('services-transaksiitem.destroy');
        Route::get('/services/transaksi/loadform/{id}', [TransaksiItemServicesController::class, 'loadForm'])->name('services-transaksi.loadform');
    });

    Route::middleware(['owner'])->group(function () {
        Route::get('/admin/dashboard', [OwnerController::class, 'dashboard'])->name('admin.index');
        Route::get('/admin/dashboard/pemasukan', [OwnerController::class, 'pemasukan'])->name('admin-pemasukan.total');

        Route::get('/admin/users', [OwnerController::class, 'user'])->name('admin-users.index');
        Route::post('/admin/users/store', [OwnerController::class, 'store_user'])->name('admin-users.store');
        Route::get('/admin/users/destroy/{id}', [OwnerController::class, 'destroy_user'])->name('admin-users.destroy');

        Route::get('/admin/pasien', [PasienOwnerController::class, 'index'])->name('admin-pasien.index');
        Route::get('/admin/pasien/create', [PasienOwnerController::class, 'create'])->name('admin-pasien.create');
        Route::post('/admin/pasien/store', [PasienOwnerController::class, 'store'])->name('admin-pasien.store');
        Route::get('/admin/pasien/{id}', [PasienOwnerController::class, 'show'])->name('admin-pasien.show');
        Route::put('/admin/pasien/{id}', [PasienOwnerController::class, 'update'])->name('admin-pasien.update');
        Route::delete('/admin/pasien/{id}', [PasienOwnerController::class, 'destroy'])->name('admin-pasien.destroy');
        Route::get('/admin/diagnosapasien/{id}', [DoktorController::class, 'diagnosapasien'])->name('admin.diagnosapasien');
        Route::get('/admin/appointment', [AppointmentOwnerController::class, 'index'])->name('admin-appointment.index');
        Route::get('/admin/appointment/create', [AppointmentOwnerController::class, 'create'])->name('admin-appointment.create');
        Route::post('/admin/appointment/store', [AppointmentOwnerController::class, 'store'])->name('admin-appointment.store');
        Route::get('/admin/appointment/{id}', [AppointmentOwnerController::class, 'show'])->name('admin-appointment.show');
        Route::put('/admin/appointment/{id}', [AppointmentOwnerController::class, 'update'])->name('admin-appointment.update');
        Route::delete('/admin/appointment/{id}', [AppointmentOwnerController::class, 'destroy'])->name('admin-appointment.destroy');
        Route::get('/admin/all/appointment/', [OwnerController::class, 'appointment_all'])->name('admin-appointment.all');
        // Route::get('admin/appointment/pasien/{id}', [ServicesController::class, 'getpasien'])->name('admin.getpasien');

        //jasa controller
        Route::get('/admin/jasa', [ProductJasaOwnerController::class, 'jasa'])->name('admin-jasa.index');
        Route::post('/admin/jasa/store', [ProductJasaOwnerController::class, 'storejasa'])->name('admin-jasa.store');
        Route::get('/admin/jasa/edit/{id}', [ProductJasaOwnerController::class, 'editjasa'])->name('admin-jasa.edit');
        Route::put('/admin/jasa/update/{id}', [ProductJasaOwnerController::class, 'updatejasa'])->name('admin-jasa.update');
        Route::delete('/admin/jasa/delete/{id}', [ProductJasaOwnerController::class, 'deletejasa'])->name('admin-jasa.delete');

        Route::get('/admin/transaksi-berobat', [TransaksiJasaOwnerController::class, 'index'])->name('admin-transaksi-jasa.index');
        // Route::post('/admin/transaksi-berobat/store', [TransaksiJasaOwnerController::class, 'store'])->name('admin-transaksi-jasa.store');
        Route::post('/admin/transaksi-berobat/update', [TransaksiJasaOwnerController::class, 'update'])->name('admin-transaksi-jasa.update');
        Route::get('/admin/transaksi-berobat/data', [TransaksiJasaOwnerController::class, 'data'])->name('admin-transaksi-jasa.data');
        Route::get('/admin/transaksi-berobat/create/{id}', [TransaksiJasaOwnerController::class, 'create'])->name('admin-transaksi-jasa.create');
        Route::post('/admin/transaksi-item-berobat/store', [TransaksiItemJasaOwnerController::class, 'store'])->name('admin-transaksi-jasaitem.store');
        Route::get('/admin/transaksi-item-berobat/data/{id}', [TransaksiItemJasaOwnerController::class, 'data'])->name('admin-transaksi-jasaitem.data');
        Route::get('/admin/transaksi-item-berobat/datajasa/{id}', [TransaksiItemJasaOwnerController::class, 'datajasa'])->name('admin-transaksi-jasaitem.datajasa');
        Route::delete('/admin/transaksi-item-berobat/delete/{id}', [TransaksiItemJasaOwnerController::class, 'destroy'])->name('admin-transaksi-jasaitem.destroy');
        Route::get('/admin/transaksi-berobat/loadform/{id}', [TransaksiItemJasaOwnerController::class, 'loadForm'])->name('admin-transaksi-jasa.loadform');

        //data product resource
        Route::get('/admin/product/data', [OwnerController::class, 'data'])->name('admin-product.data');

        //product controller
        Route::get('/admin/product', [OwnerController::class, 'product'])->name('admin-product.index');
        Route::post('/admin/product/store', [OwnerController::class, 'storeproduct'])->name('admin-product.store');
        Route::get('/admin/product/edit/{id}', [OwnerController::class, 'editproduct'])->name('admin-product.edit');
        Route::put('/admin/product/update/{id}', [OwnerController::class, 'updateproduct'])->name('admin-product.update');
        Route::delete('/admin/product/delete/{id}', [OwnerController::class, 'deleteproduct'])->name('admin-product.delete');

        //categori Product
        // Route::resource('/apoteker/categoriproduct', CategoriController::class);

        //transaksi pembelian
        Route::get('/admin/transaksi-pembelian', [TransaksiOwnerController::class, 'index'])->name('admin-transaksi-product.index');
        Route::post('/admin/transaksi/store', [TransaksiOwnerController::class, 'store'])->name('admin-transaksi-product.store');
        Route::post('/admin/transaksi/update', [TransaksiOwnerController::class, 'update'])->name('admin-transaksi-product.update');
        // Route::get('/apoteker/')
        Route::get('/admin/transaksi-pembelian/data', [TransaksiOwnerController::class, 'data'])->name('admin-transaksi-product.data');
        Route::get('/admin/transaksi-pembelian/create/{id}', [TransaksiOwnerController::class, 'create'])->name('admin-transaksi-product.create');
        Route::post('/admin/transaksi-item-pembelian/store', [TransaksiItemOwnerController::class, 'store'])->name('admin-transaksiitem-product.store');
        Route::get('/admin/transaksi-item-pembelian/data/{id}', [TransaksiItemOwnerController::class, 'data'])->name('admin-transaksiitem-product.data');
        Route::delete('/admin/transaksi-item-pembelian/delete/{id}', [TransaksiItemOwnerController::class, 'destroy'])->name('admin-transaksiitem-product.destroy');
        Route::get('/admin/transaksi-pembelian/loadform/{id}', [TransaksiItemOwnerController::class, 'loadForm'])->name('admin-transaksi.loadform');
    });

    Route::get('logout', [LoginController::class, 'logout'])->name('logout');
});
