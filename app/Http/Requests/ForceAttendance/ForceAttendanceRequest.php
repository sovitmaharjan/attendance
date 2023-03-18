<?php

namespace App\Http\Requests\ForceAttendance;

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
            'branch' => 'required',
            'department' => 'required',
            'employee' => 'required',
            'employee_id' => 'required',
            'from_date' => 'required|date|date_format:Y-m-d',
            'to_date' => 'required|date|date_format:Y-m-d|after_or_equal:from_date',
            'force_attendance' => 'required',
        ];
    }

    public function messages()
    {
        return  [
            'force_attendance.required' => 'Force Attendance data(list) is missing',
        ];
    }
}
