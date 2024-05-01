<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ImportGuardianData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-guardian-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import guardian data from database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {
            DB::unprepared(file_get_contents('database/migrations/sql/guardians.sql'));
            $this->info('Guardian data imported');
        } catch (\Exception $e) {
            var_dump($e->getMessage());
        }
    }
}
