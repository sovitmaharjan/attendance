<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

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
        'login_id',
        'supervisor',
        'password',
        'login_count',
        'status',
        'type',
        'role_id'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'dob' => 'datetime',
        'join_date' => 'datetime'
    ];
}
