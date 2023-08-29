<?php

namespace Database\Seeders;

use App\Models\ProfileWeb;
use Illuminate\Database\Seeder;

class ProfileWebSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProfileWeb::Create([
            'name' => 'Bengkel Ganteng',
            'alamat' => 'Padang Pariaman, Sumatera Barat'
        ]);
    }
}
