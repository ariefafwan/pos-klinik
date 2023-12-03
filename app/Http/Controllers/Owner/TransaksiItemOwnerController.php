<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Transaksi;
use App\Models\TransaksiItem;
use Carbon\Carbon;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\DataTables;

class TransaksiItemOwnerController extends Controller
{
    public function store(Request $request)
    {
        $produk = Product::findOrFail($request->id_produk);

        if ($produk->stock < $request->qty) {
            return response()->json('Stock Tidak Cukup', 200);
        }

        $detailstore = new TransaksiItem();
        $detailstore->transaksi_id = $request->transaksi_id;
        $detailstore->product_id = $produk->id;
        $detailstore->name = $produk->name;
        $detailstore->qty = $request->qty;
        $detailstore->harga = $produk->harga_jual;
        $detailstore->subtotal = $produk->harga_jual * $request->qty;
        $detailstore->pemasukan = $produk->harga_jual * $request->qty - $produk->harga_beli * $request->qty;
        $detailstore->save();

        $produk->stock = $produk->stock - $request->qty;
        $produk->save();

        return response()->json('Berhasil', 200);
    }

    public function data($id)
    {
        // $idtransaksi = session('id_transaksi');
        $detail = TransaksiItem::with('product')
            ->where('transaksi_id', $id)
            ->get();
        $data = array();

        foreach ($detail as $item) {
            $row = array();
            // $row['kode_produk'] = '<span class="label label-success">' . $item->produk['kode_produk'] . '</span';
            $row['nama_produk'] = $item->name;
            $row['harga']  = uang($item->harga);
            $row['jumlah']      = $item->qty;
            $row['subtotal']    = uang($item->subtotal);
            $row['aksi']        = '<div class="btn-group">
                                    <button onclick="deleteData(`' . route('admin-transaksiitem-product.destroy', $item->id) . '`)" class="btn btn-xs btn-danger btn-flat"><i class="bi bi-trash"></i></button>
                                   </div>';
            $data[] = $row;
        }

        return DataTables::of($data)
            ->addIndexColumn()
            ->rawColumns(['aksi', 'kode_produk', 'jumlah'])
            ->make(true);
    }

    public function destroy($id)
    {
        $item = TransaksiItem::findOrFail($id);
        $produk = Product::findOrFail($item->product_id);
        $produk->stock = $produk->stock + $item->qty;
        $produk->save();
        $item->delete();

        return back();
    }

    public function loadForm($id)
    {
        $transaksiitem = TransaksiItem::where('transaksi_id', $id)->get();
        $total_harga = $transaksiitem->sum("subtotal");
        $item = $transaksiitem->sum('qty');
        $pemasukan = $transaksiitem->sum('pemasukan');

        $data  = [
            'total' => $total_harga,
            'total_harga' => uang($total_harga),
            'total_item' => $item,
            'pemasukan' => $pemasukan,
            'terbilang' => ucwords(terbilang($total_harga) . ' Rupiah')
        ];

        return response()->json($data);
    }
}
