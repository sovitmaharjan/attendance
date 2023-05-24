<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkHourAssignment extends Model
{
    use HasFactory;

    protected $fillable = [
        'work_hour_id',
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

    public function workHour()
    {
        return $this->belongsTo(WorkHour::class);
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
