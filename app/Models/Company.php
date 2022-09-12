<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillables = [
        'name',
        'code',
        'address',
        'email',
        'phone',
        'mobile',
        'website',
        'extra',
    ];

    public function status()
    {
        return $this->morphOne(ModelHasStatus::class, 'model');
    }
}
