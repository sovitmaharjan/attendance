<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Event extends Model
{
    use HasFactory, HasSlug, SoftDeletes;

    protected $fillable = ['title', 'slug', 'from_date', 'to_date', 'extras', 'status'];

    protected $casts = [
        'extras' => 'array',
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
        ->generateSlugsFrom('title')
        ->saveSlugsTo('slug');
    }

    public function employees()
    {
        return $this->belongsToMany(User::class, 'employee_event');
    }
}
