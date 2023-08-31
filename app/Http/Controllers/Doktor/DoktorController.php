<?php

namespace App\Http\Controllers\Doktor;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Diagnosa;
use App\Models\Pasien;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\DataTables;

class DoktorController extends Controller
{
    public function dashboard()
    {
        $page = 'Dashboard Doktor';
        return view('doktor.dashboard', compact('page'));
    }

    public function jadwaltoday()
    {
        $page = "Appointment Today";
        return view('doktor.appointment.today', compact('page'));
    }

    public function datatoday()
    {
        $today = Appointment::where('user_id', Auth::user()->id)->where('status', 'Berjalan')->where('tanggal', Carbon::now()->format('Y-m-d'))->get();
        return DataTables::of($today)
            // ->editColumn('jadwal', function ($today) {
            //     return $today->tanggal . "/" . $today->jam;
            // })
            // ->addIndexColumn()
            ->addColumn('aksi', function ($today) {
                return '
                <div class="d-flex justify-content-evenly">
                    <a href="/doktor/diagnosa/berlangsung/' . $today->id . '" class="btn btn-xs btn-info btn-flat"><i class="bi bi-pencil-fill"></i></a>
                </div>
                ';
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function jadwalall()
    {
        $page = "Your All Appointment";
        return view('doktor.appointment.all', compact('page'));
    }

    public function dataall()
    {
        $all = Appointment::where('user_id', Auth::user()->id)->where('status', 'Berjalan')->get();
        return DataTables::of($all)
            // ->addIndexColumn()
            ->editColumn('jadwal', function ($today) {
                return $today->tanggal . " / " . $today->jam;
            })
            // ->addColumn('aksi', function ($today) {
            //     return '
            //     <div class="d-flex justify-content-evenly">
            //         <button onclick="editForm(`' . route('categoriproduct.update', $categori->id) . '` , `' . ($categori->id) . '`)" class="btn btn-xs btn-info btn-flat"><i class="bi bi-pencil"></i></button>
            //         <button onclick="deleteData(`' . route('categoriproduct.destroy', $categori->id) . '`)" class="btn btn-xs btn-danger btn-flat"><i class="bi bi-trash"></i></button>
            //     </div>
            //     ';
            // })
            // ->rawColumns(['aksi'])
            ->make(true);
    }

    public function berlangsung($id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->status = "Berlangsung";
        $appointment->save();

        return redirect()->route('diagnosa.create', $id);
    }

    public function diagnosauser($id)
    {
        $page = "Diagnosa User";
        $appointment = Appointment::findOrFail($id);
        return view('doktor.diagnosa.create', compact('page', 'appointment'));
    }

    public function storediagnosa(Request $request)
    {
        $request->validate([
            'appointment_id' => 'required',
            'pasien_id' => 'required',
            'hasil' => 'required',
            'catatan' => 'required',
            'user_id' => 'required',
        ]);

        $data = new Diagnosa();
        $data->appointment_id = $request->appointment_id;
        $data->pasien_id = $request->pasien_id;
        $data->user_id = $request->user_id;
        $data->hasil = $request->hasil;
        $data->catatan = $request->catatan;
        $data->save();

        $app = Appointment::findOrFail($request->appointment_id);
        $app->status = "Selesai";
        $app->save();

        Alert::success('Informasi Pesan', "Berhasil Menambahkan Diagnosa User");
        return redirect()->route('jadwal.today');
    }
}
