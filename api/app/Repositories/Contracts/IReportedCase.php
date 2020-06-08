<?php 
namespace App\Repositories\Contracts;

use Illuminate\Http\Request;

interface IReportedCase
{
    public function getFilable();
    public function getDefaultFields();
    public function getLastestReportDate();
    public function search(Request $request);
}