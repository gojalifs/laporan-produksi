<?php

namespace Database\Seeders;

use App\Models\User;
use Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            "name" => "Wahyudi",
            "email" => "wahyudi@gmail.com",
            "password" => Hash::make("password"),
            "bagian" => "Press Welding",
            "departemen" => "Production",
            "role" => "produksi",
        ]);

        User::create([
            "name" => "Pauji",
            "email" => "pauji@gmail.com",
            "password" => Hash::make("password"),
            "bagian" => "Admin Produksi",
            "departemen" => "Production",
            "role" => "admin",
        ]);
    }
}
