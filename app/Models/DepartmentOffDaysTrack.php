<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DepartmentOffDaysTrack extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['department_id', 'days', 'date', 'date_time'];

    protected $casts = [
      'days' => 'array'
    ];
}
