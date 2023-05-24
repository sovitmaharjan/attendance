<?php

namespace App\Http\Requests\WorkHour;

use Illuminate\Foundation\Http\FormRequest;

class WorkHourAssignmentRequest extends FormRequest
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
            'off_day' => 'required',
            'work_hour_repeater' => 'required',
            'work_hour_repeater.*.work_hour' => 'required|distinct',
            'work_hour_repeater.*.from_date' => 'required|date|date_format:Y-m-d',
            'work_hour_repeater.*.to_date' => 'required|date|date_format:Y-m-d',
            'work_hour_repeater.*.nepali_from_date' => 'required|date|date_format:Y-m-d',
            'work_hour_repeater.*.nepali_to_date' => 'required|date|date_format:Y-m-d'
        ];
    }

    public function messages()
    {
        return  [
            'work_hour_repeater.*.work_hour.required' => 'The work hour field is required',
            'work_hour_repeater.*.work_hour.distinct' => 'The work hour field has a duplicate value.',
            'work_hour_repeater.*.from_date.required' => 'The from field is required',
            'work_hour_repeater.*.to_date.required' => 'The to field is required',
            'work_hour_repeater.*.nepali_from_date.required' => 'The from field is required',
            'work_hour_repeater.*.nepali_to_date.required' => 'The to field is required'
        ];
    }
}
