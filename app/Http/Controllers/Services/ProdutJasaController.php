<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\DataTables;

class ProdutJasaController extends Controller
{
    public function jasa(Request $request)
    {
        $page = "Daftar Jasa";

        if ($request->ajax()) {
            $produk = Product::where('kategori', 'Jasa')->get();

            return DataTables::of($produk)
                ->addIndexColumn()
                ->editColumn('diperbarui', function ($produk) {
                    return $produk->ProductDate;
                })
                ->addColumn('aksi', function ($produk) {
                    return '
                <div class="d-flex justify-content-evenly">
                <button onclick="editForm(`' . route('jasa.update', $produk->id) . '` , `' . ($produk->id) . '`)" class="btn btn-xs btn-info btn-flat"><i class="bi bi-pencil"></i></button>
                <button onclick="deleteData(`' . route('jasa.delete', $produk->id) . '`)" class="btn btn-xs btn-danger btn-flat"><i class="bi bi-trash"></i></button>
                </div>
                ';
                })
                ->rawColumns(['aksi'])
                ->make(true);
        }
        return view('services.jasa.index', compact('page'));
    }

    public function storejasa(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'biaya' => 'required|numeric|gt:0',
        ]);

        $produk = new Product();
        $produk->name = $request->name;
        $produk->biaya = $request->biaya;
        $produk->kategori = 'Jasa';
        $produk->save();

        // return response()->json('Data berhasil disimpan', 200);
        Alert::success("Informasi Pesan", "Jasa Berhasil Disimpan");
        return back();
    }

    public function editjasa($id)
    {
        $product = Product::findOrFail($id);
        return json_encode($product);
    }

    public function updatejasa(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'biaya' => 'required|numeric|gt:0',
        ]);

        $produk = Product::findOrFail($id);
        $produk->name = $request->name;
        $produk->biaya = $request->biaya;
        $produk->save();

        Alert::success('Informasi Pesan', 'Berhasil Mengupdate Jasa');
        return back();
    }

    public function deletejasa($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        Alert::success('Informasi Pesan', 'Berhasil Menghapus Jasa');
        return back();
    }
}
