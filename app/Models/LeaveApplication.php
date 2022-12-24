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
        'from_date',
        'to_date',
        'leave_days_count',
        'description',
        'is_approved',
        'approver',
        'extra'
    ];

    public $casts = [
        'date' => 'datetime'
    ];

    public function leave_application_dates()
    {
        return $this->hasMany(LeaveApplicationDate::class);
    }
}
