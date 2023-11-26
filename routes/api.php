<?php

use App\Http\Controllers\Apoteker\ApotekerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/apoteker/product/data', [ApotekerController::class, 'data'])->name('product.data');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
