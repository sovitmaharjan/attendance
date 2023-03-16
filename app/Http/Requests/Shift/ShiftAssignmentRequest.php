<?php

namespace App\Http\Requests\Shift;

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
            'shift_repeater.*.nepali_from_date' => 'required|date|date_format:Y-m-d',
            'shift_repeater.*.nepali_to_date' => 'required|date|date_format:Y-m-d'
        ];
    }

    public function messages()
    {
        return  [
            'shift_repeater.*.shift.required' => 'The shift field is required',
            'shift_repeater.*.from_date.required' => 'The from field is required',
            'shift_repeater.*.to_date.required' => 'The to field is required',
            'shift_repeater.*.nepali_from_date.required' => 'The from field is required',
            'shift_repeater.*.nepali_to_date.required' => 'The to field is required'
        ];
    }
}
