<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class SiteSetting extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'key',
        'value',
        'text',
        'extra'
    ];

    public static $keys = [
        "company_name" => [
            "type" => "text",
            "element" => "text",
            "visible" => 1,
            "display_text" => "Company Name"
        ],
        "email" => [
            "type" => "text",
            "element" => "text",
            "visible" => 1,
            "display_text" => "Email"
        ],
        "address" => [
            "type" => "text",
            "element" => "text",
            "visible" => 1,
            "display_text" => "Address"
        ],
        "phone" => [
            "type" => "text",
            "element" => "text",
            "visible" => 1,
            "display_text" => "Phone"
        ],
        "mobile" => [
            "type" => "text",
            "element" => "text",
            "visible" => 1,
            "display_text" => "Mobile"
        ],
        "website" => [
            "type" => "text",
            "element" => "text",
            "visible" => 0,
            "display_text" => "Website"
        ],
        "site_logo" => [
            "type" => "image",
            "element" => "image",
            "visible" => 1,
            "display_text" => "Site Logo"
        ],
        "site_icon" => [
            "type" => "image",
            "element" => "image",
            "visible" => 1,
            "display_text" => "Site Icon"
        ],
    ];
}
