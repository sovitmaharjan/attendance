<?php

namespace App\Http\Requests\WorkHour;

use Illuminate\Foundation\Http\FormRequest;

class StoreWorkHourRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|unique:work_hours',
            'in_time' => 'required|date_format:H:i',
            'in_time_last' => 'nullable|date_format:H:i',
            'out_time' => 'required|date_format:H:i',
            'out_time_last' => 'nullable|date_format:H:i',
            'break_time' => 'nullable|numeric',
            'shift' => 'nullable',
            'is_default' => 'nullable',
            'status' => 'nullable',
            'extra' => 'nullable'
        ];
    }
}
