<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Holiday extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'from_date',
        'to_date',
        'quantity',
        'extra'
    ];

    public $casts = [
        'from_date' => 'date',
        'to_date' => 'date',
        'extra' => 'array'
    ];

    public function holiday_dates()
    {
        return $this->hasMany(HolidayDate::class);
    }
}
