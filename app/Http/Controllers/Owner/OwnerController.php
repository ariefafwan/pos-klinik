<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Pasien;
use App\Models\User;
use App\Models\Appointment;
use App\Models\Transaksi;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\DataTables;

class OwnerController extends Controller
{
    public function dashboard(Request $request)
    {
        $page = 'Dashboard Admin';
        $appointment_today = count(Appointment::all()->where('tanggal', Carbon::now()->format('Y-m-d')));
        $total_appointment = count(Appointment::get());
        $pemasukan = Transaksi::whereMonth('tanggal', Carbon::now()->month)->get();
        $total_pemasukan = $pemasukan->sum('pemasukan');
        if ($request->ajax()) {
            // $users = User::with('role')->where('role_id', '!=', 4)->get();
            $tanggal_mulai = $request->input('tanggal_mulai');
            $tanggal_selesai = $request->input('tanggal_selesai');
            // dd($tanggal_mulai);
            $transaksi = Transaksi::where('tanggal', '>=', $tanggal_mulai)->where('tanggal', '<=', $tanggal_selesai)->orderBy('created_at')->get();

            return DataTables::of($transaksi)
                ->addIndexColumn()
                ->make(true);
        }
        return view('admin.dashboard', compact('page', 'total_appointment', 'appointment_today', 'total_pemasukan'));
    }

    public function pemasukan(Request $request)
    {
        // dd(true);
        $tanggal_mulai = $request->input('tanggal_mulai');
        $tanggal_selesai = $request->input('tanggal_selesai');
        $transaksi = Transaksi::where('tanggal', '>=', $tanggal_mulai)->where('tanggal', '<=', $tanggal_selesai)->orderBy('created_at')->get();
        $pemasukan = $transaksi->sum('pemasukan');

        return response()->json($pemasukan);
    }

    public function user(Request $request)
    {
        $page = 'User';
        $roles = Role::where('id', '!=', 4)->get();
        if ($request->ajax()) {
            $users = User::with('role')->where('role_id', '!=', 4)->get();
            return DataTables::of($users)
                ->addIndexColumn()
                ->addColumn('aksi', function ($users) {
                    return '<div class="d-flex justify-content-evenly">
                                <button onclick="deleteData(`' . route('admin-users.destroy', $users->id) . '`)" class="btn btn-xs btn-danger btn-flat"><i class="bi bi-trash"></i></button>
                            </div>';
                })
                ->rawColumns(['aksi'])
                ->make(true);
        }
        return view('admin.users.index', compact('page', 'roles'));
    }

    public function store_user(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'role_id' => ['required'],
            // 'password' => ['required', 'string', 'min:8'],
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make('password');
        $user->role_id = $request->role_id;
        $user->save();

        // User::create([
        //     'name' => $request->name,
        //     'email' => $request->email,
        //     'password' => Hash::make('password'),
        //     'role_id' => $request->role_id,
        // ]);

        // return response()->json('Data berhasil disimpan', 200);
        Alert::success("Informasi Pesan", "Berhasil Menambahkan User");
        return back();
    }

    public function destroy_user($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        Alert::success("Informasi Pesan", "Berhasil Menghapus User");
        return back();
    }

    public function product()
    {
        $page = "Daftar Produk";
        // $type = Product::select('kategori')->distinct()->get();
        return view('admin.product.index', compact('page'));
    }

    public function data()
    {
        $produk = Product::where('kategori', 'barang')->get();

        return DataTables::of($produk)
            ->addIndexColumn()
            ->editColumn('diperbarui', function ($produk) {
                return $produk->ProductDate;
            })
            ->editColumn('hargabeli', function ($produk) {
                return uang($produk->harga_beli);
            })
            ->editColumn('hargajual', function ($produk) {
                return uang($produk->harga_jual);
            })
            ->addColumn('aksi', function ($produk) {
                return '
                <div class="d-flex justify-content-evenly">
                <button onclick="editForm(`' . route('admin-product.update', $produk->id) . '` , `' . ($produk->id) . '`)" class="btn btn-xs btn-info btn-flat"><i class="bi bi-pencil"></i></button>
                <button onclick="deleteData(`' . route('admin-product.delete', $produk->id) . '`)" class="btn btn-xs btn-danger btn-flat"><i class="bi bi-trash"></i></button>
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
            // 'ka' => 'required|numeric',
            'stock' => 'required|numeric|digits_between:0,3',
        ]);

        $produk = new Product();
        $produk->name = $request->name;
        $produk->harga_beli = $request->harga_beli;
        $produk->harga_jual = $request->harga_jual;
        $produk->kategori = 'Barang';
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
            // 'categori_id' => 'required|numeric',
            'stock' => 'required|numeric|digits_between:0,3',
        ]);

        $produk = Product::findOrFail($id);
        $produk->name = $request->name;
        $produk->harga_beli = $request->harga_beli;
        $produk->harga_jual = $request->harga_jual;
        // $produk->categori_id = $request->categori_id;
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
                    <button onclick="editForm(`' . route('admin-appointment.update', $appointment->id) . '` , `' . ($appointment->id) . '`)" class="btn btn-xs btn-info btn-flat"><i class="bi bi-pencil"></i></button>
                    <button onclick="deleteData(`' . route('admin-appointment.destroy', $appointment->id) . '`)" class="btn btn-xs btn-danger btn-flat"><i class="bi bi-trash"></i></button>
                </div>
                ';
                })
                ->rawColumns(['aksi'])
                ->make(true);
        }
        return view('admin.appointment.all', compact('page', 'pasien', 'doktor'));
    }
}
