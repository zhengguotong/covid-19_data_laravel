<?php

namespace App\Http\Controllers;

use App\Http\Resources\ReportedCaseResource;
use App\Repositories\Contracts\IReportedCase;
use App\Repositories\Eloquent\Criteria\ReportDate;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReportedCaseController extends Controller
{
    protected $reportedCase;

    public function __construct(IReportedCase $reportedCase)
    {
        $this->reportedCase = $reportedCase;
    }

    public function index(Request $request)
    {
        $per_page = 1000;
        if ($request->per_page) {
            $per_page = $request->per_page;
        }

        $lastest_reported_date = $this->reportedCase->getLastestReportDate();
        if ($lastest_reported_date) {
            $repotedCases = $this->reportedCase->withCriteria([
                new ReportDate($lastest_reported_date)
            ])->paginate($per_page);
            return ReportedCaseResource::collection($repotedCases);
        }

        return response()->json(null, 200);
    }

    public function regionTotal(Request $request)
    {
        $repotedCases = $this->reportedCase->getRegionTotal($request);
        return JsonResource::collection($repotedCases);
    }

    public function search(Request $request)
    {
        $repotedCases = $this->reportedCase->search($request);
        return ReportedCaseResource::collection($repotedCases);
    }
}
