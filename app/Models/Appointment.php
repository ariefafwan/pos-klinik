<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $with = ['user', 'pasien'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pasien()
    {
        return $this->belongsTo(Pasien::class);
    }
}
