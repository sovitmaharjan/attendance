<?php

namespace App\Http\Requests\Employee;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmployeeRequest extends FormRequest
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
            'gender' => ['required'],
            'marital_status' => ['required'],
            'dob' => ['required', 'date', 'date_format:Y-m-d'],
            'nepali_dob' => ['required'],
            'join_date' => ['required', 'date', 'date_format:Y-m-d'],
            'nepali_join_date' => ['required'],
            'phone' => ['required'],
            'address' => ['required'],
            'email' => ['required'],
            'branch_id' => ['required'],
            'department_id' => ['required'],
            'designation_id' => ['required'],
            'role_id' => ['required'],
            'login_id' => ['required'],
            'supervisor_id' => ['nullable'],
            'status' => ['required'],
            'type' => ['required'],
            'official_email' => ['nullable'],
            'base64' => ['nullable']
        ];
    }
}
