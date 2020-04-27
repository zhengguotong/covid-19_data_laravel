<?php 

namespace App\Repositories\Eloquent;

use App\DailyCase;
use App\Repositories\Contracts\IDailyCase;
use App\Repositories\Eloquent\BaseRepository;

class DailyCaseRepository extends BaseRepository implements IDailyCase
{
    public function model()
    {
        return DailyCase::class;
    }

    public function getFilable($has_admin_field = false)
    {
        return $this->model->getFillable();
    }

}