<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProfileWeb;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use DataTables;

class ProductController extends Controller
{
    public function product()
    {
        $product = Product::paginate(10);
        $toko = ProfileWeb::all();
        $page = "Daftar Produk";
        $type = Product::select('type')->distinct()->get();
        return view('admin.product.index', compact('page', 'product', 'toko', 'type'));
    }

    public function test()
    {
        // $product = Product::paginate(10);
        $toko = ProfileWeb::all();
        $page = "Daftar Produk";
        $type = Product::select('type')->distinct()->get();
        return view('admin.product.test', compact('page', 'toko', 'type'));
    }

    public function data()
    {
        $produk = Product::all();

        return DataTables::of($produk)
            ->addIndexColumn()
            ->editColumn('diperbarui', function ($produk) {
                return $produk->ProductDate;
            })
            ->addColumn('aksi', function ($produk) {
                return '
                <div class="d-flex justify-content-evenly">
                    <button onclick="editForm(`' . route('test.update', $produk->id) . '`)" class="btn btn-xs btn-info btn-flat"><i class="bi bi-pencil"></i></button>
                    <button onclick="deleteData(`' . route('product.destroy', $produk->id) . '`)" class="btn btn-xs btn-danger btn-flat"><i class="bi bi-trash"></i></button>
                </div>
                ';
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function store(Request $request)
    {
        $produk = new Product();
        $produk->name = $request->name;
        $produk->harga_beli = $request->harga_beli;
        $produk->harga_jual = $request->harga_jual;
        $produk->type = $request->type;
        $produk->stock = $request->stock;
        $produk->save();

        // return response()->json('Data berhasil disimpan', 200);
        return back()->with('Data Berhasil Disimpan');
    }

    public function show($id)
    {
        $produk = Product::find($id);

        return response()->json($produk);
    }

    public function update(Request $request, $id)
    {
        $produk = Product::findOrFail($id);
        $produk->name = $request->name;
        $produk->harga_beli = $request->harga_beli;
        $produk->harga_jual = $request->harga_jual;
        $produk->type = $request->type;
        $produk->stock = $request->stock;
        $produk->update();

        return response()->json('Data berhasil disimpan', 200);
    }

    public function storeproduct(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'harga_beli' => 'required|numeric|gt:0',
            'harga_jual' => 'required|numeric|gt:0',
            'type' => 'required',
            'stock' => 'required|numeric',
        ]);

        $produk = new Product();
        $produk->name = $request->name;
        $produk->harga_beli = $request->harga_beli;
        $produk->harga_jual = $request->harga_jual;
        $produk->type = $request->type;
        $produk->stock = $request->stock;
        $produk->save();

        Alert::success('Informasi Pesan', 'Berhasil Menambahkan Product');
        return redirect()->route('product.index');
    }

    public function editproduct($id)
    {
        $product = Product::findOrFail($id);
        return json_encode($product);
    }

    public function updateproduct(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'harga_beli' => 'required|numeric|gt:0',
            'harga_jual' => 'required|numeric|gt:0',
            'type' => 'required',
            'stock' => 'required',
        ]);

        $produk = Product::findOrFail($request->id);
        $produk->name = $request->name;
        $produk->harga_beli = $request->harga_beli;
        $produk->harga_jual = $request->harga_jual;
        $produk->type = $request->type;
        $produk->stock = $request->stock;
        $produk->save();

        Alert::success('Informasi Pesan', 'Berhasil Mengupdate Product');
        return redirect()->route('product.index');
    }

    public function deleteproduct($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        Alert::success('Informasi Pesan', 'Berhasil Menghapus Product');
    }
}
