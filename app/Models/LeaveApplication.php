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
        'leave_duration',
        'description',
        'status',
        'extra'
    ];

    public $casts = [
        'date' => 'date',
        'extra' => 'array'
    ];

    public function leave_application_dates()
    {
        return $this->hasMany(LeaveApplicationDate::class);
    }
}
