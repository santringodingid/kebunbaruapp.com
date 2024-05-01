<?php

namespace Database\Seeders;

use App\Models\Domicile;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DomicileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Domicile::query()->create(['name' => 'Bahasa Jawa', 'gender' => 0]);
        Domicile::query()->create(['name' => 'Bahasa Indonesia', 'gender' => 0]);
        Domicile::query()->create(['name' => 'Bahasa Arab', 'gender' => 0]);
        Domicile::query()->create(['name' => 'Bahasa Inggris', 'gender' => 0]);
        Domicile::query()->create(['name' => 'Khusus Tahfidz al-Qur\'an', 'gender' => 0]);

        Domicile::query()->create(['name' => 'A', 'gender' => 1]);
        Domicile::query()->create(['name' => 'B', 'gender' => 1]);
        Domicile::query()->create(['name' => 'C', 'gender' => 1]);
        Domicile::query()->create(['name' => 'D', 'gender' => 1]);
        Domicile::query()->create(['name' => 'E', 'gender' => 1]);
        Domicile::query()->create(['name' => 'F', 'gender' => 1]);
        Domicile::query()->create(['name' => 'Bahasa Arab', 'gender' => 1]);
        Domicile::query()->create(['name' => 'Bahasa Inggris', 'gender' => 1]);
        Domicile::query()->create(['name' => 'Khusus Tahfidz al-Qur\'an', 'gender' => 1]);
        Domicile::query()->create(['name' => 'Khusus Pengabdian', 'gender' => 1]);
    }
}
