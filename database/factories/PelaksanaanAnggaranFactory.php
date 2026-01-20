<?php

namespace Database\Factories;

use App\Models\Kinerja;
use App\Models\PelaksanaanAnggaran;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PelaksanaanAnggaran>
 */
class PelaksanaanAnggaranFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\Illuminate\Database\Eloquent\Model>
     */
    protected $model = PelaksanaanAnggaran::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // Mengambil ID random dari table kinerjas (pastikan table sudah ada datanya)
            'kinerja_id'       => Kinerja::pluck('id')->random(),
            // Membuat kalimat random untuk nama program
            'program_kegiatan' => $this->faker->sentence(3),
            // Membuat angka random untuk anggaran (misal antara 1jt sampai 500jt)
            'jumlah_anggaran'  => $this->faker->numberBetween(1000000, 500000000),
            // Membuat angka random untuk target (misal 1-100)
            'target_kegiatan'  => $this->faker->numberBetween(1, 100),
        ];
    }
}
