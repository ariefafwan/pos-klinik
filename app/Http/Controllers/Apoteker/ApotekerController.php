<?php

namespace App\Http\Controllers\Apoteker;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Categori;
use App\Models\Product;
use App\Models\Transaksi;
use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\DataTables;

class ApotekerController extends Controller
{
    public function dashboard()
    {
        $page = 'Dashboard Apoteker';
        // $appointment_today = count(Appointment::all()->where('status', 'Berjalan')->where('tanggal', Carbon::now()->format('Y-m-d')));
        // $total_appointment = count(Appointment::get());
        $pemasukan_bulanan = Transaksi::where('type', 'Pembelian')->whereMonth('tanggal', Carbon::now()->month)->get();
        $pembelian_bulanan = count(Transaksi::where('type', 'Pembelian')->whereMonth('tanggal', Carbon::now()->month)->get());
        $pembelian_harian = count(Transaksi::where('type', 'Pembelian')->where('tanggal', Carbon::now()->format('Y-m-d'))->get());
        $total_bulanan = $pemasukan_bulanan->sum('pemasukan');
        // $total_harian = $pemasukan_harian->sum('pemasukan');
        return view('apoteker.dashboard', compact('page', 'total_bulanan', 'pembelian_bulanan', 'pembelian_harian'));
    }

    public function product()
    {
        $page = "Daftar Produk";
        // $type = Product::select('kategori')->distinct()->get();
        return view('apoteker.product.index', compact('page'));
    }

    public function data()
    {
        $produk = Product::where('kategori', 'barang')->get();

        return DataTables::of($produk)
            ->addIndexColumn()
            ->editColumn('diperbarui', function ($produk) {
                return $produk->ProductDate;
            })
            ->editColumn('hargabeli', function ($produk) {
                return uang($produk->harga_beli);
            })
            ->editColumn('hargajual', function ($produk) {
                return uang($produk->harga_jual);
            })
            ->addColumn('aksi', function ($produk) {
                return '
                <div class="d-flex justify-content-evenly">
                <button onclick="editForm(`' . route('product.update', $produk->id) . '` , `' . ($produk->id) . '`)" class="btn btn-xs btn-info btn-flat"><i class="bi bi-pencil"></i></button>
                <button onclick="deleteData(`' . route('product.delete', $produk->id) . '`)" class="btn btn-xs btn-danger btn-flat"><i class="bi bi-trash"></i></button>
                </div>
                ';
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function storeproduct(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'harga_beli' => 'required|numeric|gt:0',
            'harga_jual' => 'required|numeric|gt:0',
            // 'ka' => 'required|numeric',
            'stock' => 'required|numeric|digits_between:0,3',
        ]);

        $produk = new Product();
        $produk->name = $request->name;
        $produk->harga_beli = $request->harga_beli;
        $produk->harga_jual = $request->harga_jual;
        $produk->kategori = 'Barang';
        $produk->stock = $request->stock;
        $produk->save();

        // return response()->json('Data berhasil disimpan', 200);
        Alert::success("Informasi Pesan", "Produk Berhasil Disimpan");
        return back();
    }

    public function editproduct($id)
    {
        $product = Product::findOrFail($id);
        return json_encode($product);
    }

    public function updateproduct(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'harga_beli' => 'required|numeric|gt:0',
            'harga_jual' => 'required|numeric|gt:0',
            // 'categori_id' => 'required|numeric',
            'stock' => 'required|numeric|digits_between:0,3',
        ]);

        $produk = Product::findOrFail($id);
        $produk->name = $request->name;
        $produk->harga_beli = $request->harga_beli;
        $produk->harga_jual = $request->harga_jual;
        // $produk->categori_id = $request->categori_id;
        $produk->stock = $request->stock;
        $produk->save();

        Alert::success('Informasi Pesan', 'Berhasil Mengupdate Product');
        return back();
    }

    public function deleteproduct($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        Alert::success('Informasi Pesan', 'Berhasil Menghapus Product');
        return back();
    }
}
