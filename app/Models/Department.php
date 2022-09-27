<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Company;
use App\Models\Branch;

class Department extends Model
{
    use HasFactory, SoftDeletes;

    protected static function booted()
    {
        if (auth()->user()) {
            static::addGlobalScope('company', function ($q) {
                $q->where('company_id', auth()->user()->company_id);
            });
        }
    }

    protected $fillable = [
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

    public function company_detail()
    {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }


    public function branch_detail()
    {
        return $this->belongsTo(Branch::class, 'branch_id', 'id');

    }

    public function company()
    {
        return $this->belongsTo(Company::class);
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
