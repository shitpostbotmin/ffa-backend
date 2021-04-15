<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CreateDatabaseFile extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ffa:create-database-file';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates an empty database file.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        file_put_contents('/mnt/efs/database.sqlite', '');
        // fopen('/efs/database.sqlite', 'w');
        return 0;
    }
}
