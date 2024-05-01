<?php

namespace Database\Seeders;

use App\Models\SettingManagement\Institution;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InstitutionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Institution::query()->create([
            'code' => 'BPSTI',
            'name' => 'Badan Pengembangan Sistem dan Teknologi Informasi',
            'commission' => 'UMUM',
            'gender_access' => 2,
            'status_access' => 0,
            'status' => 1,
        ]);
    }
}
