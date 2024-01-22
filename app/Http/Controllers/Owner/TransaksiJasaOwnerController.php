<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use RealRashid\SweetAlert\Facades\Alert;

class TransaksiJasaOwnerController extends Controller
{
    public function index()
    {
        $page = "Daftar Transaksi";
        $transaksi = Transaksi::where('type', 'Berobat')->get();
        return view('admin.transaksi.index', compact('transaksi', 'page'));
    }

    public function data()
    {
        $transaksi = Transaksi::where('type', 'Berobat')->where('status', 'Berjalan')->get();

        return DataTables::of($transaksi)
            ->addIndexColumn()
            ->addColumn('aksi', function ($transaksi) {
                return '
                <div class="d-flex justify-content-evenly">
                <button onclick="pembayaran(`' . route('admin-transaksi-jasa.create', $transaksi->id) . '`)" class="btn btn-xs btn-info btn-flat"><i class="bi bi-pencil"></i></button>
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
        $transaksi->status = 'Selesai';
        $transaksi->save();

        Alert::success('Informasi Pesan', "Sukses Mengatur Transaksi");
        return redirect()->route('admin-transaksi-jasa.index');
    }

    public function create($id)
    {
        $page = "Tambah Transaksi";
        $produk = Product::where('kategori', 'Barang')->where('stock', '>', 0)->get();
        $transaksi = Transaksi::find($id);
        $id_transaksi = $transaksi->id;
        return view('admin.transaksi.create', compact('page', 'produk', 'id_transaksi'));
    }
}
