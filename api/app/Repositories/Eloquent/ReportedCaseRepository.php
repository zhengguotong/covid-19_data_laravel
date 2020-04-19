<?php 

namespace App\Repositories\Eloquent;

use App\ReportedCase;
use App\Repositories\Contracts\IReportedCase;
use App\Repositories\Eloquent\BaseRepository;

class ReportedCaseRepository extends BaseRepository implements IReportedCase
{
    public function model()
    {
        return ReportedCase::class;
    }

    public function getFilable($has_admin_field = false)
    {
        return $this->model->getFillable();
    }

    public function getDefaultFields()
    {
        return $this->model->getDefaultFiles();
    }
}