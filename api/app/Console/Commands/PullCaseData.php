<?php

namespace App\Console\Commands;

use App\Jobs\UpdateDailyCase;
use Illuminate\Console\Command;
use Config;
use Carbon\Carbon;
use App\Repositories\Contracts\IReportedCase;
use App\Repositories\Eloquent\Criteria\ReportDate;

class PullCaseData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pull_case_data:pull {action=pull} {start?} {end?}  {--flush}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to pull data from github repo';

    protected $reportCase;
    protected $columsChangedDate;
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(IReportedCase $reportCase)
    {
        parent::__construct();
        $this->reportCase = $reportCase;
        $this->columsChangedDate = Carbon::createFromFormat('m-d-Y', Config::get('covid19.colums_changed_date'));
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $action = $this->argument('action');
        $start = $this->argument('start');
        $end = $this->argument('end');
        $flush = $this->option('flush');

        if (!$start || $flush) {
            $start = Config::get('covid19.first_date');
        }

        if (!$end || $flush) {
            $end = Carbon::today()->format('m-d-Y');
        }

        $end =  Carbon::createFromFormat('m-d-Y', $end);
        $currentDate = Carbon::createFromFormat('m-d-Y', $start);
        switch ($action) {
            case 'dispatch':
                $this->dispatchJobs($end, $currentDate);
                break;
            default:
                $this->pullCaseData($end, $currentDate);
                break;
        }
    }

    protected function dispatchJobs($end, $currentDate)
    {
        while ($currentDate->lessThanOrEqualTo($end)) {
            $reportCase = resolve('App\Repositories\Contracts\IReportedCase');
            $date = $currentDate->format('Y-m-d');
            $this->info('Dispatch ' .  $date   . ' update daily case data job.');
            $cases = $reportCase->withCriteria([
                new ReportDate($currentDate->format('Y-m-d'))
            ])->all();

            if ($cases && count($cases) > 0) {
                foreach ($cases as $case) {
                    UpdateDailyCase::dispatch($case);
                }
            }
            $this->info('Total ' . count($cases) . ' jobs Dispatch');
            $cases = null;
            $currentDate = $currentDate->addDay();
        }
    }

    protected function pullCaseData($end,  $currentDate)
    {
        while ($currentDate->lessThan($end)) {
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
            $has_admin_field = $currentDate->gt($this->columsChangedDate);
            $headers  = $this->getHeader($has_admin_field);
            for ($i = 1; $i < count($rows); $i++) {
                $tmp = str_getcsv($rows[$i]);
                $row = $this->reportCase->getDefaultFields();
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
                    $this->reportCase->updateOrCreate($condition, $row);
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
