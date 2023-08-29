<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Roles;
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

        Roles::Create([
            'name' => 'Apoteker'
        ]);

        Roles::Create([
            'name' => 'Doktor'
        ]);

        Roles::Create([
            'name' => 'Services'
        ]);

        User::Create([
            'name' => 'apotek',
            'email' => 'apotek@gmail.com',
            'password' => Hash::make('password'),
            'role_id' => 1
        ]);

        User::Create([
            'name' => 'doktor',
            'email' => 'doktor@gmail.com',
            'password' => Hash::make('password'),
            'role_id' => 1
        ]);

        User::Create([
            'name' => 'services',
            'email' => 'services@gmail.com',
            'password' => Hash::make('password'),
            'role_id' => 1
        ]);
    }
}
