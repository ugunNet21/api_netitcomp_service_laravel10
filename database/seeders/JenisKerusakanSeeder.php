<?php

namespace Database\Seeders;

use App\Models\JenisKerusakan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JenisKerusakanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        JenisKerusakan::factory()->count(5)->create();
    }
}
