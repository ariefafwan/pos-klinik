<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'type',
        'invoice',
        'total',

    ];

    public function transaksiitem()
    {
        return $this->hasMany(TransaksiItem::class);
    }

    static function tambah_transaksi()
    {
        $idgen = time() . rand(100, 999);
        $data = Transaksi::create([
            'status' => "Selesai",
            'timestamp' => date('Y-m-d'),
            'invoice' => $idgen,
        ]);

        return $data->id;
    }

    static function update_transaksi($transaksi_id, $harga)
    {
        Transaksi::find($transaksi_id)->update([
            'total' => $harga,
        ]);
    }
}
