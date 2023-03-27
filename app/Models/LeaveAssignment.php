<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveAssignment extends Model
{
    use HasFactory;

    protected $fillable = [
        'leave_id',
        'employee_id',
        'year',
        'allotted_days',
        'carried_over_days',
        'extra'
    ];

    protected $casts = [
        'extra' => 'array'
    ];

    public function remaining_days()
    {
        return $this->hasOne(RemainingLeave::class);
    }
}
