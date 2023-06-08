<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Event extends Model
{
    use HasFactory, HasSlug;

    protected $fillable = ['title', 'slug', 'from_date', 'to_date', 'duration', 'extra', 'status'];

    protected $casts = [
        'from_date' => 'date',
        'to_date' => 'date',
        'extra' => 'array'
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

    public function eventDates()
    {
        return $this->hasMany(EventDate::class);
    }
}
