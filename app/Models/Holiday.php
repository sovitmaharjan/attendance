<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Holiday extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'date',
        'holiday_type_id',
        'quantity'
    ];

    public $casts = [
        'date' => 'datetime'
    ];

    public function holidayType()
    {
        return $this->belongsTo(HolidayType::class);
    }
}
