<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Leave extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'leave_type_id',
        'allowed_days'
    ];

    public function leaveType()
    {
        return $this->belongsTo(LeaveType::class);
    }
}
