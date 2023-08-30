<?php

namespace App\Http\Controllers\Apoteker;

use App\Http\Controllers\Controller;
use App\Models\Categori;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\DataTables;

class CategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $page = "Category Product";
        $categori = Categori::all();
        return view('apoteker.categori.index', compact('page', 'categori'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categori = Categori::all();
        return DataTables::of($categori)
            ->addIndexColumn()
            ->addColumn('aksi', function ($categori) {
                return '
                <div class="d-flex justify-content-evenly">
                    <button onclick="editForm(`' . route('categoriproduct.update', $categori->id) . '` , `' . ($categori->id) . '`)" class="btn btn-xs btn-info btn-flat"><i class="bi bi-pencil"></i></button>
                    <button onclick="deleteData(`' . route('categoriproduct.destroy', $categori->id) . '`)" class="btn btn-xs btn-danger btn-flat"><i class="bi bi-trash"></i></button>
                </div>
                ';
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $categori = new Categori();
        $categori->name = $request->name;
        $categori->save();

        Alert::success("Informasi Pesan", "Kategori Produk Berhasil Disimpan");
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $categori = Categori::findOrFail($id);
        return json_encode($categori);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $categori = Categori::findOrFail($id);
        $categori->name = $request->name;
        $categori->save();

        Alert::success('Informasi Pesan', 'Berhasil Mengupdate Ketegori Product');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Categori::findOrFail($id);
        $product->delete();
        Alert::success('Informasi Pesan', 'Berhasil Menghapus Product');
    }
}
