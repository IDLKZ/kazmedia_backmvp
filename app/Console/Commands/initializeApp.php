<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class initializeApp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'start:app';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'All features to start and deploying app';

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
        try{
            \Artisan::call("migrate");
            $this->info("Successfully migrate");

        }
        catch (\Exception $exception){
            $this->error("Error when migrating, full error:");
            $this->error($exception);
        }
        try{

        }
        catch (\Exception $exception){
            $this->error("Error when seeding, full error:");
            $this->error($exception);

        }
    }
}
