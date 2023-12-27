<?php

namespace Database\Factories;

use App\Models\Notifikasi;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Notifikasi>
 */
class NotifikasiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Notifikasi::class;
    public function definition()
    {
        $pemesananId = \App\Models\Pemesanan::inRandomOrder()->first()->id;

        return [
            'judul' => $this->faker->sentence,
            'isi_pesan' => $this->faker->paragraph,
            'tanggal_dikirim' => $this->faker->date,
            'pemesanan_id' => $pemesananId,
        ];
    }
}
