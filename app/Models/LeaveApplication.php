<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveApplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'leave_id',
        'employee_id',
        'from_date',
        'to_date',
        'leave_days_count',
        'description',
        'is_approved',
        'extra'
    ];

    public $casts = [
        'date' => 'date'
    ];

    public function leave_application_dates()
    {
        return $this->hasMany(LeaveApplicationDate::class);
    }
}
