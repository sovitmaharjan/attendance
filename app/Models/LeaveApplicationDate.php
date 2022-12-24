<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveApplicationDate extends Model
{
    use HasFactory;

    protected $fillable = [
        'leave_application_id',
        'date'
    ];

    public $casts = [
        'date' => 'datetime'
    ];
}
