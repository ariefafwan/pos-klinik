<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiItem extends Model
{
    use HasFactory;

    protected $with = ['transaksi', 'product'];

    protected $fillable = [
        'transaksi_id',
        'product_id',
        'qty',
        'harga',
        'name',
    ];

    static function tambah_item_transaksi($product_id, $transaksi_id, $qty, $harga, $name)
    {
        TransaksiItem::create([
            "product_id" => $product_id,
            "transaksi_id" => $transaksi_id,
            "qty" => $qty,
            "harga" => $harga,
            "name" => $name,
        ]);
    }

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
