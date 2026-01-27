<?php

namespace Database\Seeders;

use App\Models\Jabatan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JabatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        collect([
            ['nama_jabatan'     => 'kepala dinas'],
            ['nama_jabatan'     => 'sekertaris'],
            ['nama_jabatan'     => 'Fungsional Perencana Ahli Madya'],
            ['nama_jabatan'     => 'Kabid Destinasi dan Industri Pariwisata'],
            ['nama_jabatan'     => 'Penata Kelola Sistem dan Teknologi Informasi'],
            ['nama_jabatan'     => 'Fungsional Analisa Keuangan Pusat dan Daerah - Ahli Muda'],
            ['nama_jabatan'     => 'Adyatama Kepariwisataan dan Ekonomi Kreatif Ahli Pratama'],
            ['nama_jabatan'     => 'Pranata Komputer Ahli Pertama'],
            ['nama_jabatan'     => 'staf'],
        ])->each( function ($item) {
            Jabatan::create($item);
        });
    }
}
