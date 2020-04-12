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
    protected $signature = 'pull_case_data:pull {start?} {end?} {--flush}';

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
        $file = file_get_contents('https://raw.githubusercontent.com/CSSEGISandData/COVID-19/master/csse_covid_19_data/csse_covid_19_daily_reports/03-13-2020.csv');
        $rows = explode("\n",$file);
        $cases = array();
        $headers = str_getcsv($rows[0]);
        
        for($i=1; $i < count($rows) ; $i++){
             $tmp = str_getcsv($rows[$i]);
             $row = array();
             for($k = 0 ; $k < count($tmp); $k++){
                 $row[$headers[$k]] = $tmp[$k]; 
             }
             $cases[] = $row;
        }
        dd($cases);
       
    }
}
