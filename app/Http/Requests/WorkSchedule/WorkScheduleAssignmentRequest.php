<?php

namespace App\Http\Requests\WorkSchedule;

use Illuminate\Foundation\Http\FormRequest;

class WorkScheduleAssignmentRequest extends FormRequest
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
            'work_schedule_repeater' => 'required',
            'work_schedule_repeater.*.work_schedule' => 'required|distinct',
            'work_schedule_repeater.*.from_date' => 'required|date|date_format:Y-m-d',
            'work_schedule_repeater.*.to_date' => 'required|date|date_format:Y-m-d',
            'work_schedule_repeater.*.nepali_from_date' => 'required|date|date_format:Y-m-d',
            'work_schedule_repeater.*.nepali_to_date' => 'required|date|date_format:Y-m-d'
        ];
    }

    public function messages()
    {
        return  [
            'work_schedule_repeater.*.work_schedule.required' => 'The work schedule field is required',
            'work_schedule_repeater.*.work_schedule.distinct' => 'The work schedule field has a duplicate value.',
            'work_schedule_repeater.*.from_date.required' => 'The from field is required',
            'work_schedule_repeater.*.to_date.required' => 'The to field is required',
            'work_schedule_repeater.*.nepali_from_date.required' => 'The from field is required',
            'work_schedule_repeater.*.nepali_to_date.required' => 'The to field is required'
        ];
    }
}
