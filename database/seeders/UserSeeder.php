<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
        //
        public function run()
    {
        User::create([
            'name' => 'Direktur Utama',
            'email' => 'direktur@instansi.id',
            'password' => Hash::make('password123'),
            'role' => 'direktur',
        ]);

        User::create([
            'name' => 'Tata Usaha',
            'email' => 'tu@instansi.id',
            'password' => Hash::make('password123'),
            'role' => 'tu',
        ]);

        User::create([
            'name' => 'Kabag',
            'email' => 'kabag@instansi.id',
            'password' => Hash::make('password123'),
            'role' => 'kabag',
        ]);

        User::create([
            'name' => 'Kasubag',
            'email' => 'kasubag@instansi.id',
            'password' => Hash::make('password123'),
            'role' => 'kasubag',
        ]);

        User::create([
            'name' => 'PJ',
            'email' => 'pj@instansi.id',
            'password' => Hash::make('password123'),
            'role' => 'pj',
        ]);
    
    }
}
