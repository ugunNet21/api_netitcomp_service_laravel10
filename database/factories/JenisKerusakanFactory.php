<?php

namespace Database\Factories;

use App\Models\JenisKerusakan;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\JenisKerusakan>
 */
class JenisKerusakanFactory extends Factory
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
    protected $model = JenisKerusakan::class;
    public function definition()
    {
        return [
            'nama_jenis_kerusakan' => $this->faker->word,
            'deskripsi' => $this->faker->sentence,
        ];
    }
}
