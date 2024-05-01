<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            EmploymentSeeder::class,
            EducationSeeder::class,
            PeriodSeeder::class,
            InstitutionSeeder::class,
            UserSeeder::class,
            RolePermissionSeeder::class,
            DomicileSeeder::class
        ]);
    }
}
