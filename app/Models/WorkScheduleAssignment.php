<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkScheduleAssignment extends Model
{
    use HasFactory;

    protected $fillable = [
        'work_schedule_id',
        'employee_id',
        'assigned_date',
        'assigned_day',
        'off_day',
        'extra'
    ];

    protected $casts = [
        'assigned_date' => 'date',
        'extra' => 'array',
    ];

    public function workSchedule()
    {
        return $this->belongsTo(WorkSchedule::class);
    }

    public function employee()
    {
        return $this->belongsTo(User::class);
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }
}
