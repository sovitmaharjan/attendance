<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Branch;

class Department extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'address',
        'email',
        'phone',
        'mobile',
        'status',
        'extra'
    ];

    protected $casts = [
        'extra' => 'array'
    ];

    public function branch_detail()
    {
        return $this->belongsTo(Branch::class, 'branch_id', 'id');
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function employees()
    {
        return $this->hasMany(User::class);
    }
}
