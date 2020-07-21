<?php

namespace App\Repositories\Eloquent\Criteria;

use App\Repositories\Criteria\ICriterion;

class DateLocation implements ICriterion
{
    protected $report_date;
    protected $region;
    protected $province;
    protected $admin2;

    public function __construct($report_date, $region, $province, $admin2)
    {
        $this->reported_date = $report_date;
        $this->region = $region;
        $this->province = $province;
        $this->admin2 = $admin2;
    }

    public function apply($model)
    {
        return $model->where('report_date', $this->reported_date)
            ->Where('region', $this->region)
            ->Where('province', $this->province)
            ->Where('admin2', $this->admin2);
    }
}
