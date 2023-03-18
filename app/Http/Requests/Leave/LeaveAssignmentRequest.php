<?php

namespace App\Http\Requests\Leave;

use Illuminate\Foundation\Http\FormRequest;

class LeaveAssignmentRequest extends FormRequest
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
            'leave_repeater.*.leave' => 'required|distinct',
            'leave_repeater.*.year' => 'required|integer|date_format:Y',
            'leave_repeater.*.allowed_days' => 'required|integer'
        ];
    }

    public function messages()
    {
        return  [
            'leave_repeater.*.leave.required' => 'The leave field is required.',
            'leave_repeater.*.leave.distinct' => 'The leave field has a duplicate value.',
            'leave_repeater.*.year.required' => 'The year field is required.',
            'leave_repeater.*.year.date_format' => 'The year format is invalid - format (YYYY | ' . now()->format('Y') . ').',
            'leave_repeater.*.allowed_days.required' => 'The allowed days field is required.',
        ];
    }
}
