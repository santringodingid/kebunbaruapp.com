<?php

namespace Database\Seeders;

use App\Models\Education;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EducationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Education::query()->create(['name' => 'Tidak Tamat SD/Sederajat']);
        Education::query()->create(['name' => 'Tamat SD/Sederajat']);
        Education::query()->create(['name' => 'Tamat SMP/Sederajat']);
        Education::query()->create(['name' => 'Tamat SMA/Sederajat']);
        Education::query()->create(['name' => 'Sarjana/Diploma']);
        Education::query()->create(['name' => 'Pascasarjana']);
        Education::query()->create(['name' => 'Pondok Pesantren']);
    }
}
