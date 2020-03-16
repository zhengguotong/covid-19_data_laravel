<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class PullCaseData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pull_case_data:pull';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to pull data from github repo';

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
     * @return mixed
     */
    public function handle()
    {
        //
    }
}
