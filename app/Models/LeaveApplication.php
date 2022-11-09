<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LeaveApplication extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'leave_id',
        'employee_id',
        'start_date',
        'end_date',
        'leave_days_count',
        'remaining_allowed_days',
        'description',
        'is_approved',
        'approver',
        'extra'
    ];

    public $casts = [
        'date' => 'datetime'
    ];
}
