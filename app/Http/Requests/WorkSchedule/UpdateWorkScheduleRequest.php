<?php

namespace App\Http\Requests\WorkSchedule;

use Illuminate\Foundation\Http\FormRequest;

class UpdateWorkScheduleRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|unique:work_schedules,name,' . $this->route('work_schedule')->id,
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
