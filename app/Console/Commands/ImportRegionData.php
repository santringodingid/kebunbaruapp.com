<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ImportRegionData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-region-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import region data from old database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {
            DB::unprepared(file_get_contents('database/migrations/sql/regions.sql'));
            $this->info('Region data imported');
        } catch (\Exception $e) {
            var_dump($e->getMessage());
        }
    }
}
