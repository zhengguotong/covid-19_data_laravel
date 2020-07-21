<?php
namespace App\Repositories\Contracts;

use Illuminate\Http\Request;

interface IDailyCase
{
    public function getFilable();
    public function search(Request $request);
    public function getRegionTotal(Request $request);
}
