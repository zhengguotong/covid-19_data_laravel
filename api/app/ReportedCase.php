<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReportedCase extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'admin2',
        'province',
        'region',
        'last_update',
        'confirmed',
        'deaths',
        'recovered',
        'active',
        'longitude',
        'latitude',
        'report_date',
    ];

    public function getFillable()
    {
        return $this->fillable;
    }

    public function getDefaultFiles()
    {
        return array(
            'admin2' => '',
            'province' => '',
            'region' => '',
            'last_update' => '',
            'confirmed' => 0,
            'deaths' => 0,
            'recovered' => 0,
            'active' => 0,
            'longitude' => 0.00,
            'latitude' => 0.00,
            'report_date' => '',
        );
    }
}
