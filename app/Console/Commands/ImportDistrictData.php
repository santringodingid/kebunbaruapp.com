<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ImportDistrictData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-district-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import district data from old database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {
            DB::unprepared(file_get_contents('database/migrations/sql/districts.sql'));
            $this->info('District data imported');
        } catch (\Exception $e) {
            var_dump($e->getMessage());
        }
    }
}
