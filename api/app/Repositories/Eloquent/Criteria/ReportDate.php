<?php
namespace App\Repositories\Eloquent\Criteria;

use App\Repositories\Criteria\ICriterion;

class ReportDate implements ICriterion
{
    protected $report_date;

    public function __construct($report_date)
    {
        $this->reported_date = $report_date;
    }

    public function apply($model)
    {
        return $model->where('report_date', $this->reported_date);
    }
}
