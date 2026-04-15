<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Akun Admin
        User::updateOrCreate(
            ['email' => 'admin@perpus.com'],
            [
                'name'     => 'Administrator Perpustakaan',
                'password' => Hash::make('admin123'),
                'role'     => 'admin',
            ]
        );

        // Akun Siswa
        User::updateOrCreate(
            ['email' => 'siswa@perpus.com'],
            [
                'name'     => 'Budi Santoso (Siswa)',
                'password' => Hash::make('siswa123'),
                'role'     => 'user',
            ]
        );
    }
}