<?php 
namespace App\Repositories\Contracts;

interface IReportedCase
{
    public function getFilable();
    public function  getDefaultFields();
}