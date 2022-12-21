<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LeaveApplicationRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'leave_id' => 'required',
            'employee_id' => 'required',
            'from_date' => 'required',
            'to_date' => 'required',
            'leave_days_count' => 'required',
            'description' => 'required',
            'approver' => 'nullable',
        ];
    }
}
