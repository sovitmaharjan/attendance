<?php

namespace App\Http\Requests\SiteSetting;

use App\Models\SiteSetting;
use Illuminate\Foundation\Http\FormRequest;

class SiteSettingRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $keys = SiteSetting::$keys;
        $data = [];
        foreach($keys as $key => $value) {
            $data[$key] = $key == 'company_name' ? 'required' : 'nullable';
        }
        return $data;
    }
}
