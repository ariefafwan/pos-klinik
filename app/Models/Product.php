<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $fillable = ['name', 'harga_beli', 'harga_jual', 'type', 'stock'];

    protected $with = ['categori'];

    static function detail_produk($id)
    {
        $data = Product::where('id', $id)->first();

        return $data;
    }

    public function transaksiitem()
    {
        return $this->belongsTo(TransaksiItem::class);
    }

    public function getProductDateAttribute()
    {
        // $date = $this->created_at->format('d-m-y');
        $date = date('d-m-Y', strtotime($this->updated_at));

        $bulan = array(
            1 =>   'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        );

        $indexing = explode('-', $date);

        // index var menjadi 0 = tanggal, 1 = bulan, 2 = tahun

        return $indexing[0] . ' ' . $bulan[(int)$indexing[1]] . ' ' . $indexing[2];
        // return $indexing[2];
        // return $newDateFormat2;
    }

    public function categori()
    {
        return $this->belongsTo(Categori::class);
    }
}
