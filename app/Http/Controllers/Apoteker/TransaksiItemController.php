<?php

namespace App\Http\Controllers\Apoteker;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\TransaksiItem;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use League\Fractal\Resource\Item;
use RealRashid\SweetAlert\Facades\Alert;

class TransaksiItemController extends Controller
{
    public function store(Request $request)
    {
        $id_produk = Product::findOrFail($request->id_produk);
        $detailstore = new TransaksiItem();
        $detailstore->transaksi_id = $request->transaksi_id;
        $detailstore->product_id = $id_produk->id;
        $detailstore->name = $id_produk->name;
        $detailstore->qty = $request->qty;
        $detailstore->harga = $id_produk->harga_jual;
        $detailstore->subtotal = $id_produk->harga_jual * $request->qty;
        $detailstore->pemasukan = $id_produk->harga_jual * $request->qty - $id_produk->harga_beli * $request->qty;
        $detailstore->save();

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
                                    <button onclick="deleteData(`' . route('transaksiitem.destroy', $item->id) . '`)" class="btn btn-xs btn-danger btn-flat"><i class="bi bi-trash"></i></button>
                                   </div>';
            $data[] = $row;

            // $total += $item->harga * $item->qty;
            // $total_item += $item->qty;
        }
        // $data[] = [
        //     'nama_produk' => '',
        //     'harga'       => '',
        //     'jumlah'      => '',
        //     'subtotal'    => '',
        //     'aksi'        => '',
        // ];

        return datatables()
            ->of($data)
            ->addIndexColumn()
            ->rawColumns(['aksi', 'kode_produk', 'jumlah'])
            ->make(true);
    }

    public function destroy($id)
    {
        $item = TransaksiItem::findOrFail($id);
        $item->delete();

        return back();
    }

    public function loadForm($id)
    {
        $transaksiitem = TransaksiItem::where('transaksi_id', $id)->get();
        // $item = TransaksiItem::where('transaksi_id', $id)
        //     ->sum("qty")
        $total_harga = $transaksiitem->sum("subtotal");
        $item = $transaksiitem->sum('qty');
        $pemasukan = $transaksiitem->sum('pemasukan');

        // $total_bayar = uang($total_harga);
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
