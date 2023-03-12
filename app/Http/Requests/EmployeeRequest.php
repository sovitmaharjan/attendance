<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'prefix' => ['required'],
            'firstname' => ['required'],
            'middlename' => ['nullable'],
            'lastname' => ['required'],
            'email' => ['required', 'unique:users,email,'.request()->route()->parameter('employee')->id],
            'phone' => ['required'],
            'address' => ['required'],
            'gender' => ['required', 'in:Male,Female,Other'],
            'marital_status' => ['required'],
            'dob' => ['required', 'date', 'date_format:Y-m-d'],
            'nepali_dob' => ['nullable'],
            'join_date' => ['required', 'date', 'date_format:Y-m-d'],
            'nepali_join_date' => ['nullable'],
            'branch_id' => ['nullable'],
            'department_id' => ['nullable'],
            'login_id' => ['required'],
            'supervisor_id' => ['nullable'],
            'status' => ['required'],
            'type' => ['required'],
            'base64' => ['nullable']
        ];
    }
}
