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
            'login_id' => ['required'],

            'prefix' => ['nullable'],
            'firstname' => ['required'],
            'middlename' => ['nullable'],
            'lastname' => ['required'],

            'gender' => ['nullable'],
            'marital_status' => ['nullable'],

            'dob' => ['nullable', 'date', 'date_format:Y-m-d'],
            'nepali_dob' => ['nullable'],
            'join_date' => ['required', 'date', 'date_format:Y-m-d'],
            'nepali_join_date' => ['required'],

            'phone' => ['nullable'],
            'address' => ['nullable'],

            'email' => ['nullable'],

            'branch_id' => ['required'],
            'department_id' => ['required'],
            
            'designation_id' => ['required'],
            'role_id' => ['required'],

            'supervisor_id' => ['nullable'],
            
            'status' => ['required'],
            'type' => ['required'],
            
            'official_email' => ['nullable'],
            'base64' => ['nullable']
        ];
    }
}
