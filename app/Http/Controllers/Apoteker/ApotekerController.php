<?php

namespace App\Http\Controllers\Apoteker;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Categori;
use App\Models\Product;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\DataTables;

class ApotekerController extends Controller
{
    public function dashboard()
    {
        $page = 'Dashboard Apoteker';
        return view('apoteker.dashboard', compact('page'));
    }

    public function product()
    {
        $page = "Daftar Produk";
        $type = Product::select('categori_id')->distinct()->get();
        $categori = Categori::all();
        return view('apoteker.product.index', compact('page', 'type', 'categori'));
    }

    public function data()
    {
        $produk = Product::all();

        return DataTables::of($produk)
            ->addIndexColumn()
            ->editColumn('diperbarui', function ($produk) {
                return $produk->ProductDate;
            })
            ->editColumn('kategori', function ($produk) {
                return $produk->categori->name;
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
            'categori_id' => 'required|numeric',
            'stock' => 'required|numeric|digits_between:0,3',
        ]);

        $produk = new Product();
        $produk->name = $request->name;
        $produk->harga_beli = $request->harga_beli;
        $produk->harga_jual = $request->harga_jual;
        $produk->categori_id = $request->categori_id;
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
            'categori_id' => 'required|numeric',
            'stock' => 'required|numeric|digits_between:0,3',
        ]);

        $produk = Product::findOrFail($id);
        $produk->name = $request->name;
        $produk->harga_beli = $request->harga_beli;
        $produk->harga_jual = $request->harga_jual;
        $produk->categori_id = $request->categori_id;
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
