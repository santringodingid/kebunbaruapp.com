<?php

namespace Database\Seeders;

use App\Models\SettingManagement\Institution;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $institution = Institution::query()->find(1);
        User::create([
            'name'              => 'RAHMAN FARUQ',
            'email'             => 'rahman.faruq06@gmail.com',
            'username'          => 'er_faruq',
            'password'          => Hash::make('rahfar40010'),
            'email_verified_at' => now(),
            'institution_id'    => $institution->id
        ]);
    }
}
