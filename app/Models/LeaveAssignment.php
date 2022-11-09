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
        'allowed_days'
    ];
}
