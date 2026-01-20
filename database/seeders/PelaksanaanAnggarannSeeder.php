<?php

namespace Database\Seeders;

use App\Models\PelaksanaanAnggaran;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PelaksanaanAnggarannSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PelaksanaanAnggaran::factory()->count(5)->create();
    }
}
