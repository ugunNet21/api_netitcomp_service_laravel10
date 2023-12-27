<?php

namespace Database\Seeders;

use App\Models\Pemesanan_JenisKerusakan;
use App\Models\PemesananJenisKerusakan;
use Illuminate\Database\Seeder;

class PemesananJenisKerusakanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Pemesanan_JenisKerusakan::factory()->count(10)->create();
    }
}
