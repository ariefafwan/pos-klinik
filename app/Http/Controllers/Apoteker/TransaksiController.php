<?php

namespace App\Http\Controllers\Apoteker;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index()
    {
        $page = "Daftar Transaksi";
        $transaksi = Transaksi::all();
        return view('apoteker.transaksi.index', compact('transaksi', 'page'));
    }

    public function create()
    {
        $page = "Tambah Transaksi";
        $produk = Product::all()->where('stock', '>', 0);
        return view('apoteker.transaksi.create', compact('page', 'produk'));
    }
}
