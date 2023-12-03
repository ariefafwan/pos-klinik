<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Pasien;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\DataTables;

class AppointmentOwnerController extends Controller
{
    public function index()
    {
        $page = "Appointment";
        $appointment = Appointment::all()->where('status', 'Berjalan')->where('tanggal', Carbon::now()->format('Y-m-d'));
        $pasien = Pasien::doesntHave('status')->get();
        // $pasienall = Pasien::all();
        $doktor = User::all()->where('role_id', 2);
        return view('admin.appointment.index', compact('page', 'pasien', 'doktor', 'appointment'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $appointment = Appointment::all()->where('status', 'Berjalan');
        return DataTables::of($appointment)
            ->editColumn('pasien', function ($appointment) {
                return $appointment->pasien->nama_lengkap;
            })
            ->editColumn('doktor', function ($appointment) {
                return $appointment->user->name;
            })
            ->addColumn('aksi', function ($appointment) {
                return '
                <div class="d-flex justify-content-evenly">
                    <button onclick="editForm(`' . route('admin-appointment.update', $appointment->id) . '` , `' . ($appointment->id) . '`)" class="btn btn-xs btn-info btn-flat"><i class="bi bi-pencil"></i></button>
                    <button onclick="deleteData(`' . route('admin-appointment.destroy', $appointment->id) . '`)" class="btn btn-xs btn-danger btn-flat"><i class="bi bi-trash"></i></button>
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
            'tanggal' => 'required',
            'jam' => 'required',
            'pasien_id' => 'required',
            'keluhan' => 'required',
            'user_id' => 'required',
        ]);

        $data = new Appointment();
        $data->tiket = time() . rand(1, 100);
        $data->tanggal = $request->tanggal;
        $data->jam = $request->jam;
        $data->pasien_id = $request->pasien_id;
        $data->keluhan = $request->keluhan;
        $data->user_id = $request->user_id;
        $data->save();

        // return response()->json('Data berhasil disimpan', 200);
        Alert::success("Informasi Pesan", "Data Berhasil Disimpan");
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $appointment = Appointment::findOrFail($id);
        return json_encode($appointment);
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
            'tanggal' => 'required',
            'jam' => 'required',
            'pasien_id' => 'required',
            'keluhan' => 'required',
            'user_id' => 'required',
            'status' => 'required',
        ]);

        $data = Appointment::findOrFail($id);
        $data->tanggal = $request->tanggal;
        $data->jam = $request->jam;
        $data->pasien_id = $request->pasien_id;
        $data->keluhan = $request->keluhan;
        $data->user_id = $request->user_id;
        $data->status = $request->status;
        $data->save();

        // return response()->json('Data berhasil disimpan', 200);
        Alert::success("Informasi Pesan", "Data Berhasil Diupdate");
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->delete();

        Alert::success("Informasi Pesan", "Data Berhasil Dihapus");
        return back();
    }
}
