<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Super Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'), // Pastikan password terenkripsi
        ]);

        User::create([
            'name' => 'Agung',
            'email' => 'agung@dilogif.com',
            'password' => Hash::make('password'), // Pastikan password terenkripsi
        ]);

        User::create([
            'name' => 'Melina',
            'email' => 'melina@dilogif.com',
            'password' => Hash::make('password'), // Pastikan password terenkripsi
        ]);

        User::create([
            'name' => 'Azizah',
            'email' => 'azizah@dilogif.com',
            'password' => Hash::make('password'), // Pastikan password terenkripsi
        ]);

        User::create([
            'name' => 'Vivi',
            'email' => 'vivi@dilogif.com',
            'password' => Hash::make('password'), // Pastikan password terenkripsi
        ]);
    }
}
