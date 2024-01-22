<?php

namespace App\Http\Controllers;

use App\Models\ProfileWeb;
use App\Models\Transaksi;
use App\Models\TransaksiItem;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class CetakInvoiceController extends Controller
{
    public function cetakpdf(Request $request, $id_transaksi)
    {
        $profile = ProfileWeb::first();
        $transaksi = Transaksi::findOrFail($id_transaksi);
        $transaksiitem = TransaksiItem::where('transaksi_id', $id_transaksi)->get();
        $pdf = PDF::loadview('cetak_invoice', compact('transaksi', 'transaksiitem', 'profile'));
        return $pdf->download('nota-invoice.pdf');
    }
}
