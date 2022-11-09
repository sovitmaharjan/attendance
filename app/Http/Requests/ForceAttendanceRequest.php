<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ForceAttendanceRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            // 'employee_id' => 'required',
            // 'date' => 'required',
            // 'date.*' => 'required',
            // 'shift_id' => 'required',
            // 'shift_id.*' => 'required',
            // 'in_time' => 'nullable',
            // 'in_time.*' => 'nullable',
            // 'out_time' => 'nullable',
            // 'out_time.*' => 'nullable',
        ];
    }
}
