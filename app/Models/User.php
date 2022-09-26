<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class User extends Authenticatable implements HasMedia
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes, InteractsWithMedia;
    
    protected static function booted()
    {
        if(auth()->user()) {
            static::addGlobalScope('company', function ($q) {
                $q->where('company_id', auth()->user()->company_id);
            });
        }
    }

    protected $fillable = [
        'prefix',
        'firstname',
        'middlename',
        'lastname',
        'email',
        'phone',
        'address',
        'gender',
        'marital_status',
        'dob',
        'join_date',
        'company_id',
        'branch_id',
        'department_id',
        'designation_id',
        'login_id',
        'supervisor_id',
        'password',
        'login_count',
        'status',
        'type',
        'role_id',
        'official_email',
        'extra',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $appends = ['full_name'];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'dob' => 'datetime',
        'join_date' => 'datetime',
        'extra' => 'array',
    ];

    public function fullName(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->firstname . ' ' . ($this->middlename ? $this->middlename . ' ' : '') . $this->lastname
        );
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id', 'id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }

    public function designation()
    {
        return $this->belongsTo(Designation::class, 'designation_id', 'id');
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }
}
