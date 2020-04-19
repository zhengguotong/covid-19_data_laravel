<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Config;
use Carbon\Carbon;
use App\Repositories\Contracts\IReportedCase;

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

    protected $report_case;
    protected $colums_changed_date;
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(IReportedCase $report_case)
    {
        parent::__construct();
        $this->report_case = $report_case;
        $this->colums_changed_date = Carbon::createFromFormat('m-d-Y', Config::get('covid19.colums_changed_date'));
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $start = $this->argument('start');
        $end = $this->argument('end');
        $flush = $this->option('flush');

        if (!$start || $flush) {
            $start = Config::get('covid19.first_date');
        }

        if (!$end || $flush) {
            $end = Carbon::today()->format('m-d-Y');
        }

        $currentDate = Carbon::createFromFormat('m-d-Y', $start);
        while ($currentDate->format('m-d-Y') !== $end) {
            $this->info('Start Sync ' . $currentDate->format('m-d-Y') . ' reported case data.');
            $this->parseCaseCsv($currentDate);
            $currentDate = $currentDate->addDay();
        }
    }

    protected function parseCaseCsv($currentDate)
    {
        $file_path = Config::get('covid19.case_cvs_base_link') . $currentDate->format('m-d-Y') . '.csv';
        $file = file_get_contents($file_path);
        if ($file !== FALSE) {
            $rows = explode("\n", $file);
            $has_admin_field = $currentDate->gt($this->colums_changed_date);
            $headers  = $this->getHeader($has_admin_field);
            for ($i = 1; $i < count($rows); $i++) {
                $tmp = str_getcsv($rows[$i]);
                $row = $this->report_case->getDefaultFields();
                $row['report_date'] = $currentDate->format('Y-m-d');
                for ($k = 0; $k < count($tmp); $k++) {
                    if (!empty($tmp[$k])) {
                        $row[$headers[$k]] = $tmp[$k];
                    }
                }

                if (!empty($row['region'])) {
                    $condition = array(
                        'report_date' => $row['report_date'],
                        'province' => $row['province'],
                        'region' => $row['region']
                    );
                    if ($has_admin_field) {
                        $condition['admin2'] = $row['admin2'];
                    }
                    $row['last_update'] = $this->parseDataTime($row['last_update']);
                    $this->report_case->updateOrCreate($condition, $row);
                }
            }
        }
    }

    private function  parseDataTime($date)
    {
        return $date ? date('Y-m-d H:i:s', strtotime($date)) : '';
    }

    private function getHeader($has_admin_field)
    {
        if ($has_admin_field) {
            return  [
                'FIPS',
                'admin2',
                'province',
                'region',
                'last_update',
                'longitude',
                'latitude',
                'confirmed',
                'deaths',
                'recovered',
                'active',
                'combined_key',
                'report_date',
            ];
        } else {
            return  [
                'province',
                'region',
                'last_update',
                'confirmed',
                'deaths',
                'recovered',
                'longitude',
                'latitude',
                'report_date',
            ];
        }
    }
}
