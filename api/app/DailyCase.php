<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DailyCase extends Model
{
    protected $fillable = [
        'admin2',
        'province',
        'region',
        'confirmed',
        'deaths',
        'recovered',
        'active',
        'report_date',
    ];

    public function getFillable()
    {
        return $this->fillable;
    }
}
