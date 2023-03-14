<?php

namespace App\Http\Requests\Holiday;

use Illuminate\Foundation\Http\FormRequest;

class StoreHolidayRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|unique:holidays',
            'from_date' => 'required|date',
            'to_date' => 'required|date|after_or_equal:from_date'
        ];
    }
}