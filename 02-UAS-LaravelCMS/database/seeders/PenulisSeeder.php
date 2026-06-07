<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Penulis;
use Illuminate\Support\Facades\Hash;

class PenulisSeeder extends Seeder
{
    public function run(): void
    {
        Penulis::create([
            'nama_depan'    => 'Admin',
            'nama_belakang' => 'CMS',
            'user_name'     => 'admin',
            'password'      => Hash::make('admin123'),
            'foto'          => 'default.png',
        ]);
    }
}
