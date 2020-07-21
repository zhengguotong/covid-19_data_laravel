<?php

namespace App\Repositories\Eloquent\Criteria;

use App\Repositories\Criteria\ICriterion;

class Country implements ICriterion
{
    protected $region;

    public function __construct($region)
    {
        $this->region = $region;
    }

    public function apply($model)
    {
        return $model->Where('region', $this->region);
    }
}
