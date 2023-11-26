<?php

namespace App\Http\Controllers\Doktor;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Diagnosa;
use App\Models\Pasien;
use App\Models\Product;
use App\Models\Transaksi;
use App\Models\TransaksiItem;
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
                    <a href="/doktor/diagnosa/berlangsung/' . $today->id . '" class="btn btn-xs btn-info btn-flat"><i class="bi bi-plus"></i></a>
                    <button onclick="showUser(`' . ($today->user_id) . '`)" class="btn btn-xs btn-warning btn-flat"><i class="bi bi-eye"></i></button>
                </div>
                ';
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function diagnosapasien($user_id)
    {
        $hasil = Diagnosa::with('appointment')->where('user_id', $user_id)->orderBy('created_at', 'asc')->limit(5)->get();
        return json_encode($hasil);
    }

    public function pilihjasa()
    {
        $produk = Product::where('kategori', 'jasa')->get();
        return json_encode($produk);
    }

    public function pilihproduct()
    {
        $produk = Product::where('kategori', 'barang')->where('stock', '>', 0)->get();
        return json_encode($produk);
    }

    public function jadwalall()
    {
        $page = "Your All Appointment";
        return view('doktor.appointment.all', compact('page'));
    }

    public function dataall()
    {
        $all = Appointment::where('user_id', Auth::user()->id)->get();
        return DataTables::of($all)
            // ->addIndexColumn()
            ->editColumn('jadwal', function ($today) {
                return $today->tanggal . " / " . $today->jam;
            })->make(true);;
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
        $produk = Product::where('kategori', 'barang')->where('stock', '>', 0)->get();
        $jasa = Product::where('kategori', 'jasa')->get();
        // $transaksi = Transaksi::find($id);
        // $id_transaksi = $transaksi->id;
        return view('doktor.diagnosa.create', compact('page', 'appointment', 'produk', 'jasa'));
    }

    public function storediagnosa(Request $request)
    {
        // $produk = Product::findOrFail($request->produk[0]);
        // dd($produk);
        $request->validate([
            'appointment_id' => 'required',
            'pasien_id' => 'required',
            'hasil' => 'required',
            'catatan' => 'required',
            'user_id' => 'required',
        ]);

        if ($request->jasa) {
            $invoice = time() . rand(100, 999);
            // $pemasukan = array_sum($request->jasa);
            $transaksi = new Transaksi();
            $transaksi->invoice = $invoice;
            $transaksi->tanggal = Carbon::now();
            $transaksi->total_item = 0;
            $transaksi->total_harga = 0;
            $transaksi->pemasukan = 0;
            $transaksi->status = 'Berjalan';
            $transaksi->type = 'Berobat';
            $transaksi->save();

            if ($request->product) {
                for ($i = 0; $i < count($request->product); $i++) {
                    $produk = Product::findOrFail($request->product[$i]);
                    $detailstore = new TransaksiItem();
                    $detailstore->transaksi_id = $transaksi->id;
                    $detailstore->product_id = $produk->id;
                    $detailstore->name = $produk->name;
                    $detailstore->qty = 1;
                    $detailstore->harga = $produk->harga_jual;
                    $detailstore->subtotal = $produk->harga_jual;
                    $detailstore->pemasukan = $produk->harga_jual - $produk->harga_beli;
                    $detailstore->save();
                }
            }

            for ($x = 0; $x < count($request->jasa); $x++) {
                $produk = Product::findOrFail($request->jasa[$x]);
                $detailstore = new TransaksiItem();
                $detailstore->transaksi_id = $transaksi->id;
                $detailstore->product_id = $produk->id;
                $detailstore->name = $produk->name;
                $detailstore->harga = $produk->biaya;
                $detailstore->subtotal = $produk->biaya;
                $detailstore->pemasukan = $produk->biaya;
                $detailstore->save();
            }

            $transaksiitem = TransaksiItem::where('transaksi_id', $transaksi->id)->get();
            $total_harga = $transaksiitem->sum("subtotal");
            $pemasukan = $transaksiitem->sum('pemasukan');

            $transaksi->total_harga = $total_harga;
            $transaksi->pemasukan = $pemasukan;
            $transaksi->save();

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
        } else {
            Alert::success('Informasi Pesan', "Anda Harus Menambahkan Setidaknya Satu Jasa");
            return back();
        }
    }
}
