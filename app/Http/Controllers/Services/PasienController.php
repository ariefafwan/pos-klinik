<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use App\Models\Pasien;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\DataTables;

class PasienController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $page = "Daftar Pasien";
        return view('services.pasien.index', compact('page'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pasien = Pasien::all();
        return DataTables::of($pasien)
            ->addIndexColumn()
            ->editColumn('gender', function ($pasien) {
                return $pasien->GenderPasien;
            })
            ->editColumn('umur', function ($pasien) {
                return $pasien->UmurPasien;
            })
            ->addColumn('aksi', function ($pasien) {
                return '
                <div class="d-flex justify-content-evenly">
                    <button onclick="editForm(`' . route('pasien.update', $pasien->id) . '` , `' . ($pasien->id) . '`)" class="btn btn-xs btn-info btn-flat"><i class="bi bi-pencil"></i></button>
                    <button onclick="deleteData(`' . route('pasien.destroy', $pasien->id) . '`)" class="btn btn-xs btn-danger btn-flat"><i class="bi bi-trash"></i></button>
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
            'nik' => ['required', 'numeric', 'min:16', 'unique:' . Pasien::class],
            'nama_lengkap' => ['required'],
            'alamat' => ['required'],
            'jenis_kelamin' => ['required'],
            'pekerjaan' => ['required'],
            'tanggal_lahir' => ['required'],
            'no_hp.*' => ['required', 'regex:/^(^\+62|62|^08)(\d{3,4}-?){2}\d{3,4}$/', 'min:10'],
        ]);

        $pasien = new Pasien();
        $pasien->nik = $request->nik;
        $pasien->nama_lengkap = $request->nama_lengkap;
        $pasien->alamat = $request->alamat;
        $pasien->jenis_kelamin = $request->jenis_kelamin;
        $pasien->pekerjaan = $request->pekerjaan;
        $pasien->tanggal_lahir = $request->tanggal_lahir;
        $pasien->no_hp = $request->no_hp;
        $pasien->save();

        // return response()->json('Data berhasil disimpan', 200);
        Alert::success("Informasi Pesan", "Pasien Berhasil Disimpan");
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pasien = Pasien::findOrFail($id);
        return json_encode($pasien);
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
        $pasien = Pasien::findOrFail($id);

        if ($pasien->nik == $request->nik) {
            $request->validate([
                'nik' => ['required', 'numeric', 'min:16'],
                'nama_lengkap' => ['required'],
                'alamat' => ['required'],
                'jenis_kelamin' => ['required'],
                'pekerjaan' => ['required'],
                'tanggal_lahir' => ['required'],
                'no_hp.*' => ['required', 'regex:/^(^\+62|62|^08)(\d{3,4}-?){2}\d{3,4}$/', 'min:10'],
            ]);
        } else {
            $request->validate([
                'nik' => ['required', 'numeric', 'min:16', 'unique:' . Pasien::class],
                'nama_lengkap' => ['required'],
                'alamat' => ['required'],
                'jenis_kelamin' => ['required'],
                'pekerjaan' => ['required'],
                'tanggal_lahir' => ['required'],
                'no_hp.*' => ['required', 'regex:/^(^\+62|62|^08)(\d{3,4}-?){2}\d{3,4}$/', 'min:10'],
            ]);
        }

        $pasien->nik = $request->nik;
        $pasien->nama_lengkap = $request->nama_lengkap;
        $pasien->alamat = $request->alamat;
        $pasien->jenis_kelamin = $request->jenis_kelamin;
        $pasien->pekerjaan = $request->pekerjaan;
        $pasien->tanggal_lahir = $request->tanggal_lahir;
        $pasien->no_hp = $request->no_hp;
        $pasien->save();

        // return response()->json('Data berhasil disimpan', 200);
        Alert::success("Informasi Pesan", "Pasien Berhasil Diupdate");
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pasien = Pasien::findOrFail($id);
        $pasien->delete();

        Alert::success('Informasi Pesan', 'Berhasil Menghapus Data Pasien');
        return back();
    }
}
