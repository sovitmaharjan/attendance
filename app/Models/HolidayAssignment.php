<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HolidayAssignment extends Model
{
    use HasFactory;

    protected $fillable = [
        'holiday_id',
        'employee_id',
        'assigned_date',
        'assigned_day',
        'extra'
    ];

    protected $casts = [
        'assigned_date' => 'date',
        'extra' => 'array'
    ];
}
