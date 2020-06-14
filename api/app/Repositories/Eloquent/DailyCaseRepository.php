<?php

namespace App\Repositories\Eloquent;

use App\DailyCase;
use App\Repositories\Contracts\IDailyCase;
use App\Repositories\Eloquent\BaseRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    public function getRegionTotal(Request $request)
    {
        $per_page = 1000;
        if ($request->per_page) {
            $per_page = $request->per_page;
        }

        $query = (new $this->model)->newQuery();
        $query->select(
            'region',
            'report_date',
            DB::raw('SUM(confirmed) as daily_confirmed'),
            DB::raw('SUM(deaths) as daily_deaths'),
            DB::raw('SUM(recovered) as daily_recovered'),
            DB::raw('SUM(active) as daily_active')
        );

        if ($request->from_date) {
            $query->where('report_date', '>=',  $request->from_date);
        }

        if ($request->to_date) {
            $query->where('report_date', '<=',  $request->to_date);
        }

        //filter region
        if ($request->country) {
            $query->where('region', $request->country);
        }
        $query->groupBy('region', 'report_date');
        return $query->paginate($per_page);
    }


    public function search(Request $request)
    {
        $per_page = 1000;
        if ($request->per_page) {
            $per_page = $request->per_page;
        }

        $query = (new $this->model)->newQuery();
        $query->select(
            'region',
            'province',
            'admin2',
            'report_date',
            DB::raw('SUM(confirmed) as daily_confirmed'),
            DB::raw('SUM(deaths) as daily_deaths'),
            DB::raw('SUM(recovered) as daily_recovered'),
            DB::raw('SUM(active) as daily_active')
        );

        if ($request->from_date) {
            $query->where('report_date', '>=',  $request->from_date);
        }

        if ($request->to_date) {
            $query->where('report_date', '<=',  $request->to_date);
        }

        //filter region
        if ($request->country) {
            $query->where('region', $request->country);
        }

        //filter province
        if ($request->province) {
            $query->where('province', $request->province);
        }

        //filter admin2
        if ($request->admin2) {
            $query->where('admin2', $request->admin2);
        }

        $query->groupBy('region', 'province', 'admin2', 'report_date');
        return $query->paginate($per_page);
    }
}
