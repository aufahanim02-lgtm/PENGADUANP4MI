<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

// ✅ Import seeder dengan nama class yang BENAR
use Database\Seeders\namaseederspengaduanp4mi;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Panggil seeder utama
        $this->call(namaseederspengaduanp4mi::class);
    }
}