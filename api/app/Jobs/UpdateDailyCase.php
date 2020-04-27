<?php

namespace App\Jobs;

use App\ReportedCase;
use Config;
use App\Repositories\Eloquent\Criteria\DateLocation;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UpdateDailyCase implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $reportCase, $model, $dailyCase;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(ReportedCase $model)
    {
        $this->model = $model;
        $this->reportCase = resolve('App\Repositories\Contracts\IReportedCase');
        $this->dailyCase = resolve('App\Repositories\Contracts\IDailyCase');
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $first_date =  Carbon::createFromFormat('m-d-Y', Config::get('covid19.first_date'))->format('Y-m-d');
        $condition = array(
            'report_date' => $this->model->report_date,
            'region' => $this->model->region,
            'province' => $this->model->province,
            'admin2' => $this->model->admin2,
        );
        if ($this->model->report_date == $first_date) {
            $this->dailyCase->updateOrCreate($condition, $this->model->toArray());
        } else {
            $dailyData = $this->caclulateDailyData();
        
            $modelData = array_merge($condition, $dailyData);
            $this->dailyCase->updateOrCreate($condition, $modelData);
        }
    }

    private function caclulateDailyData()
    {
        $pervious_date = Carbon::createFromFormat('Y-m-d', $this->model->report_date)
            ->subDay()
            ->format('Y-m-d');

        $pervious_data = $this->reportCase->withCriteria([
            new DateLocation($pervious_date,  $this->model->region,  $this->model->province, $this->model->admin2),
        ])->first();


        $dailyData = array(
            'confirmed' => $this->model->confirmed,
            'deaths' => $this->model->deaths,
            'recovered' => $this->model->recovered,
            'active' => $this->model->active,
        );

        if ($pervious_data) {
           
            $pervious_data =  $pervious_data->toArray();
            foreach ($dailyData  as $key => $value) {
                $dailyData[$key] = $value - $pervious_data[$key];
            }
        }
        return  $dailyData;
    }
}
