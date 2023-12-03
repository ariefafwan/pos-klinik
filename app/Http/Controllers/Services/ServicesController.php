<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Pasien;
use App\Models\Transaksi;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\DataTables;

class ServicesController extends Controller
{
    public function dashboard()
    {
        $page = 'Dashboard Services';
        $pemasukan_bulanan = Transaksi::where('type', 'Berobat')->whereMonth('tanggal', Carbon::now()->month)->get();
        $appointment_today = count(Appointment::all()->where('tanggal', Carbon::now()->format('Y-m-d')));
        $appointment_bulanan = count(Appointment::whereMonth('tanggal', Carbon::now()->month)->get());
        $total_bulanan = $pemasukan_bulanan->sum('pemasukan');
        return view('services.dashboard', compact('page', 'appointment_today', 'appointment_bulanan', 'total_bulanan'));
    }

    public function appointment_all(Request $request)
    {
        $page = 'Dashboard Services';
        $pasien = Pasien::doesntHave('status')->get();
        $doktor = User::all()->where('role_id', 2);
        if ($request->ajax()) {
            $appointment = Appointment::all();
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
                    <button onclick="editForm(`' . route('appointment.update', $appointment->id) . '` , `' . ($appointment->id) . '`)" class="btn btn-xs btn-info btn-flat"><i class="bi bi-pencil"></i></button>
                    <button onclick="deleteData(`' . route('appointment.destroy', $appointment->id) . '`)" class="btn btn-xs btn-danger btn-flat"><i class="bi bi-trash"></i></button>
                </div>
                ';
                })
                ->rawColumns(['aksi'])
                ->make(true);
        }
        return view('services.appointment.all', compact('page', 'pasien', 'doktor'));
    }
}
