<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmployeeSubstituteDay extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['employee_id', 'work_date', 'substituted_to_date', 'extras'];

    protected $casts = [
      'extras' => 'array'
    ];
}
