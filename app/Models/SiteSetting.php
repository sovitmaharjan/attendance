<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    use HasFactory;

    public static $keys = [
        "name" => [
            "type" => "text",
            "element" => "text",
            "visible" => 1,
            "display_text" => "Name"
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
