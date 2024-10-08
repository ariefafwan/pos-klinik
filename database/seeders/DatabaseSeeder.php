<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\ProfileWeb;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // $this->call(RoleSeeder::class);

        // User::Create([
        //     'name' => 'apotek',
        //     'email' => 'apotek@gmail.com',
        //     'password' => Hash::make('password'),
        //     'role_id' => 1
        // ]);

        // User::Create([
        //     'name' => 'doktor',
        //     'email' => 'doktor@gmail.com',
        //     'password' => Hash::make('password'),
        //     'role_id' => 2
        // ]);

        // User::Create([
        //     'name' => 'services',
        //     'email' => 'services@gmail.com',
        //     'password' => Hash::make('password'),
        //     'role_id' => 3
        // ]);
        // Role::Create([
        //     'name' => 'Owner'
        // ]);

        // User::Create([
        //     'name' => 'owner',
        //     'email' => 'owner@gmail.com',
        //     'password' => Hash::make('password'),
        //     'role_id' => 4
        // ]);
        ProfileWeb::Create([
            'name' => 'Klinik Ganteng',
            'alamat' => 'Darussalam, Lhokseumawe',
            'logo' => 'logo.png'
        ]);
    }
}
