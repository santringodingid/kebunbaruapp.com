<?php

namespace Database\Seeders;

use App\Models\Employment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmploymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Employment::query()->create(['name' => 'BELUM/TIDAK BEKERJA']);
        Employment::query()->create(['name' => 'USTADZ/MUBALLIGH']);
        Employment::query()->create(['name' => 'WIRASWASTA']);
        Employment::query()->create(['name' => 'NELAYAN/PERIKANAN']);
        Employment::query()->create(['name' => 'PETANI/PEKEBUN']);
        Employment::query()->create(['name' => 'PELAJAR/MAHASISWA']);
        Employment::query()->create(['name' => 'KARYAWAN SWASTA']);
        Employment::query()->create(['name' => 'KARYAWAN HONORER']);
        Employment::query()->create(['name' => 'PEGAWAI NEGERI SIPIL']);
    }
}
