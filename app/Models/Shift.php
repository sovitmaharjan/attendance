<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'in_time',
        'in_time_last',
        'out_time',
        'out_time_last',
        'break_time',
        'extra'
    ];

    public $cast = [
        'extra' => 'array'
    ];
}
