<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RemainingLeave extends Model
{
    use HasFactory;

    protected $fillable = [
        'leave_assignment_id',
        'remaining_days'
    ];

    public function leaveAssignment()
    {
        return $this->belongsTo(LeaveAssignment::class);
    }
}
