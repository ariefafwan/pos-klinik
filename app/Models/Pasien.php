<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $fillable = ['nik', 'nama_lengkap', 'alamat', 'jenis_kelamin', 'pekerjaan', 'tanggal_lahir', 'no_hp'];

    public function getGenderPasienAttribute()
    {
        $gender = $this->jenis_kelamin;
        if ($gender == "Laki - Laki") {
            return 'L';
        } else if ($gender == "Perempuan") {
            return 'P';
        }
    }

    public function getUmurPasienAttribute()
    {
        $tahun = explode('-', $this->tanggal_lahir);
        $sekarang = Carbon::now()->format('Y');
        return $sekarang - $tahun[0] . ' Tahun';
    }

    public function appointment()
    {
        return $this->hasMany(Appointment::class);
    }

    public function diagnosa()
    {
        return $this->hasMany(Diagnosa::class);
    }
}
