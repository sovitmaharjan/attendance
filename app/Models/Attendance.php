<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'work_hour_assignment_id',
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
        'in_date_time',
        'out_date_time',
        'time_difference',
        'extra'
    ];

    protected $casts = [
        'in_date' => 'date',
        'out_date' => 'date',
        'extra' => 'array'
    ];
}
