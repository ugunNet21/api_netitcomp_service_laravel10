<?php

namespace Database\Factories;

use App\Models\Pemesanan;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pemesanan>
 */
class PemesananFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    // public function definition(): array
    // {
    //     return [
    //         //
    //     ];
    // }
    protected $model = Pemesanan::class;

    public function definition()
    {
        return [
            'deskripsi_kerusakan' => $this->faker->sentence,
            'status' => $this->faker->randomElement(['Dalam Proses', 'Selesai']),
            'tanggal_pesanan' => $this->faker->date,
            'kode_pesanan' => $this->faker->unique()->text(10),
            'user_id' => 1, // Ganti dengan id pengguna yang benar
        ];
    }
}
