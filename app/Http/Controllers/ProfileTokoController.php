<?php

namespace App\Http\Controllers;

use App\Models\ProfileWeb;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ProfileTokoController extends Controller
{
    public function settingtoko()
    {
        $toko = ProfileWeb::all();
        $page = "Setting Toko";
        return view('admin.setting.index', compact('page', 'toko'));
    }

    public function updatetoko(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'alamat' => 'required',
            'logo' => 'required|mimes:png,jpg,jpeg|max:4000'
        ]);

        $toko = ProfileWeb::findOrFail($request->id);
        $toko->name = $request->name;
        $toko->alamat = $request->alamat;
        $toko->save();

        Alert::success("Informasi Pesan", 'Berhasil Mengupdate Profile Toko');
        return redirect()->route('setting.index');
    }
}
