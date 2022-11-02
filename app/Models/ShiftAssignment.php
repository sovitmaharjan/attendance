<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShiftAssignment extends Model
{
    use HasFactory;

    protected $fillable = [
        'shift_id',
        'employee_id',
        'in_time',
        'out_time',
        'date',
        'extra'
    ];

    protected $casts = [
        'date' => 'datetime',
        'in_time' => 'datetime',
        'out_time' => 'datetime',
        'extra' => 'array',
    ];

    public function shift() {
        return $this->belongsTo(Shift::class);
    }
}
