<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShiftAssignmentRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'branch' => 'required',
            'department' => 'required',
            'employee' => 'required',
            'employee_id' => 'required',
            'shift_repeater' => 'required',
            'shift_repeater.*.shift' => 'required',
            'shift_repeater.*.from_date' => 'required|date|date_format:Y-m-d',
            'shift_repeater.*.to_date' => 'required|date|date_format:Y-m-d',
            'shift_repeater.*.nep_from_date' => 'required|date|date_format:Y-m-d',
            'shift_repeater.*.nep_to_date' => 'required|date|date_format:Y-m-d'
        ];
    }

    public function messages()
    {
        return  [
            'shift_repeater.*.shift.required' => 'The shift field is required',
            'shift_repeater.*.from_date.required' => 'The from field is required',
            'shift_repeater.*.to_date.required' => 'The to field is required',
            'shift_repeater.*.nep_from_date.required' => 'The from field is required',
            'shift_repeater.*.nep_to_date.required' => 'The to field is required'
        ];
    }
}
