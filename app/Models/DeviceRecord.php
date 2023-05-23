<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeviceRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'shift',
        'in_day',
        'in_date',
        'in_time',
        'in_mode',
        'in_remarks',

        'out_day',
        'out_date',
        'out_time',
        'out_mode',
        'out_remarks',

        'extra'
    ];

    protected $casts = [
        'in_date' => 'date',
        'out_date' => 'date',
        'extra' => 'array',
    ];
}
