<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShiftAssignment extends Model
{
    use HasFactory;

    protected $fillable = [
        'shift_id',
        'employee_id',
        'in_time',
        'out_time',
        'date',
        'extra'
    ];

    protected $casts = [
        'date' => 'datetime',
        'extra' => 'array',
    ];
}
