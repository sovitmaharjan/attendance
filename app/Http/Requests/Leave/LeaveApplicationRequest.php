<?php

namespace App\Http\Requests\Leave;

use App\Models\LeaveAssignment;
use Illuminate\Foundation\Http\FormRequest;

class LeaveApplicationRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $leave_assignment = LeaveAssignment::where([
            'leave_id' => request()->leave,
            'employee_id' => request()->employee_id
        ])->first();
        $duration_validation = $leave_assignment ? 'nullable|numeric|max:' . $leave_assignment->total_remaining_days : 'nullable|numeric';
        return [
            'branch' => 'required',
            'department' => 'required',
            'employee' => 'required',
            'employee_id' => 'required',
            'leave' => 'required',
            'from_date' => 'required|date|date_format:Y-m-d',
            'to_date' => 'required|date|date_format:Y-m-d|after_or_equal:from_date',
            'nepali_from_date' => 'required',
            'nepali_to_date' => 'required',
            'leave' => 'required',
            'description' => 'required',
            'duration' => 'numeric|max:11'
        ];
    }

    public function messages()
    {
        return [
            'description.required' => 'Leave reason field is required.',
            'duration.max' => 'Duration must not exceed available days.'
        ];
    }
}
