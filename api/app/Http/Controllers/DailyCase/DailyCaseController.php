<?php

namespace App\Http\Controllers\DailyCase;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\IDailyCase;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DailyCaseController extends Controller
{
    protected $dailyCase;

    public function __construct(IDailyCase $dailyCase)
    {
        $this->dailyCase = $dailyCase;
    }

    public function index(Request $request)
    {
        $dailyCases = $this->dailyCase->getRegionTotal($request);
        return JsonResource::collection($dailyCases);
    }

    public function search(Request $request)
    {
        $dailyCases = $this->dailyCase->search($request);
        return JsonResource::collection($dailyCases);
    }
}
