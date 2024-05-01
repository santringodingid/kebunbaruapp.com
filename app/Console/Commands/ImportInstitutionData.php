<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ImportInstitutionData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-institution-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import Institution Data From Old Database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {
            DB::unprepared(file_get_contents('database/migrations/sql/institutions.sql'));
            $this->info('Institution data imported');
        } catch (\Exception $e) {
            var_dump($e->getMessage());
        }
    }
}
