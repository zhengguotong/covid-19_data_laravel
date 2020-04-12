<?php 

namespace App\Repositories\Eloquent;

use App\ReportCase;
use App\Repositories\Contracts\IReportCase;
use App\Repositories\Eloquent\BaseRepository;

class ReportCaseRepository extends BaseRepository implements IReportCase
{
    public function model()
    {
        return ReportCase::class;
    }
}