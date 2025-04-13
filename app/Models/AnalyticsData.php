<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnalyticsData extends Model
{
    protected $fillable = [
        'platform',
        'data',
        'date',
    ];


    protected $casts = [
        'data' => 'array',
        'date' => 'date',
    ];
}