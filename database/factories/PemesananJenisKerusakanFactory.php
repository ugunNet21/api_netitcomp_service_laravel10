<?php

namespace Database\Factories;

use App\Models\Pemesanan_JenisKerusakan;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PemesananJenisKerusakanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Pemesanan_JenisKerusakan::class;
    public function definition()
    {
        return [
            'pemesanan_id' => $this->faker->numberBetween(1, 10),
            'jenis_kerusakan_id' => $this->faker->numberBetween(1, 5),
        ];
    }
}
