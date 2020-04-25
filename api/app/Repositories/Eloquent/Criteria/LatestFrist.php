<?php 

namespace App\Repositories\Eloquent\Criteria;

use App\Repositories\Criteria\ICriterion;

class Lastest implements ICriterion
{
    public function apply($model)
    {
        return $model->lastest();
    }
}