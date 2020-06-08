<?php 

namespace App\Repositories\Eloquent;

use App\ReportedCase;
use App\Repositories\Contracts\IReportedCase;
use App\Repositories\Eloquent\BaseRepository;
use Illuminate\Http\Request;

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

    public function getLastestReportDate()
    {
        return $this->model->max('report_date');
    }

    public function search(Request $request)
    {
        $query = (new $this->model)->newQuery();
        $max_reported_date = $this->getLastestReportDate();
        $query->where('report_date',$max_reported_date);
        
        //filter region
        if($request->country){
            $query->where('region', $request->country);
        }

        //filter pervious
        if($request->province){
            $query->where('province', $request->province);
        }

        //filter admin2
        if($request->admin2){
            $query->where('admin2', $request->admin2);
        }

        return $query->get();
            
    }
}