<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShiftRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'in_time' => 'required|date_format:H:i',
            'in_time_last' => 'required|date_format:H:i',
            'out_time' => 'required|date_format:H:i',
            'out_time_last' => 'required|date_format:H:i',
            'break_time' => 'required|numeric',
            'extra' => 'nullable'
        ];
    }
}
