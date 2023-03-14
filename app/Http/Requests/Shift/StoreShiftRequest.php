<?php

namespace App\Http\Requests\Shift;

use Illuminate\Foundation\Http\FormRequest;

class StoreShiftRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|unique:shifts',
            'in_time' => 'required|date_format:H:i',
            'in_time_last' => 'nullable|date_format:H:i',
            'out_time' => 'required|date_format:H:i',
            'out_time_last' => 'nullable|date_format:H:i',
            'break_time' => 'nullable|numeric',
            'extra' => 'nullable'
        ];
    }
}
