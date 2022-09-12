<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;

    protected $fillables = [
        'name',
        'code',
        'address',
        'email',
        'phone',
        'mobile',
        'extra',
    ];

    public function status()
    {
        return $this->morphOne(ModelHasStatus::class, 'model');
    }
}
