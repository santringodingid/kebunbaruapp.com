<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ImportProvinceData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-province-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import data province from old database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {
            DB::unprepared(file_get_contents('database/migrations/sql/provinces.sql'));
            $this->info('Province data imported');
        } catch (\Exception $e) {
            var_dump($e->getMessage());
        }
    }
}
