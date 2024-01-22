<?php

namespace App\Http\Controllers\Apoteker;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Transaksi;
use App\Models\TransaksiItem;
use Carbon\Carbon;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\DataTables;

class TransaksiController extends Controller
{
    public function index()
    {
        $page = "Daftar Transaksi";
        $transaksi = Transaksi::where('type', 'Pembelian');
        return view('apoteker.transaksi.index', compact('transaksi', 'page'));
    }

    public function data()
    {
        $transaksi = Transaksi::where('type', 'Pembelian')->get();

        return DataTables::of($transaksi)
            ->addIndexColumn()
            ->addColumn('aksi', function ($transaksi) {
                return '
                <div class="d-flex justify-content-evenly">
                <button onclick="addForm(`' . route('transaksi.create', $transaksi->id) . '`)" class="btn btn-xs btn-info btn-flat"><i class="bi bi-pencil"></i></button>
                <button onclick="cetakinvoice(`' . route('cetakinvoice', $transaksi->id) . '`)" class="btn btn-xs btn-success btn-flat"><i class="bi bi-printer"></i></button>
                </div>
                ';
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function update(Request $request)
    {
        $transaksi = Transaksi::findOrFail($request->idtransaksi);
        $transaksi->total_item = $request->total_item;
        $transaksi->total_harga = $request->total_harga;
        $transaksi->pemasukan = $request->pemasukan;
        $transaksi->save();

        Alert::success('Informasi Pesan', "Sukses Menambahkan Transaksi");
        return redirect()->route('transaksi.index');
    }

    public function store()
    {
        $invoice = time() . rand(100, 999);

        $transaksi = new Transaksi();
        $transaksi->invoice = $invoice;
        $transaksi->tanggal = Carbon::now();
        $transaksi->total_item = 0;
        $transaksi->type = 'Pembelian';
        $transaksi->total_harga = 0;
        $transaksi->pemasukan = 0;
        $transaksi->save();

        session(['id_transaksi' => $transaksi->id]);

        return redirect()->route('transaksi.create', $transaksi->id);
    }

    public function create($id)
    {
        // dd(session('id_transaksi'));
        $page = "Tambah Transaksi";
        $produk = Product::all()->where('kategori', 'Barang')->where('stock', '>', 0);
        $transaksi = Transaksi::find($id);
        $id_transaksi = $transaksi->id;
        return view('apoteker.transaksi.create', compact('page', 'produk', 'id_transaksi'));
    }
}
