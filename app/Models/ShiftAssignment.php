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
        'date' => 'date',
        'extra' => 'array',
    ];

    public function shift()
    {
        return $this->belongsTo(Shift::class);
    }

    public function employee()
    {
        return $this->belongsTo(User::class);
    }
}
