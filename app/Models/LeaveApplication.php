<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveApplication extends Model
{
    const CANCELLED = 'cancelled';
    const APPROVED = 'approved';
    const PENDING = 'pending';
    
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

    public function employee()
    {
        return $this->belongsTo(User::class, 'employee_id');
    }

    public function leave()
    {
        return $this->belongsTo(Leave::class);
    }
}
