<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ForceAttendance extends Model
{
    use HasFactory;

    CONST PRESENT_MESSAGE = 'Present';
    CONST ABSENT_MESSAGE = 'Absent';
    CONST IN_TIME_MESSAGE = 'Missing In Time';
    CONST OUT_TIME_MESSAGE = 'Missing Out Time';
}
