<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Holiday extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'from_date',
        'to_date',
        'quantity'
    ];

    public $casts = [
        'from_date' => 'date',
        'to_date' => 'date'
    ];

    public function holiday_dates()
    {
        return $this->hasMany(HolidayDate::class);
    }
}
