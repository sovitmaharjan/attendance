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
            'prefix' => 'required',
            'firstname' => 'required',
            'middlename' => 'nullable',
            'lastname' => 'required',
            'base64' => 'nullable',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'gender' => 'required',
            'marital_status' => 'required',
            'dob' => 'required',
            'nepali_dob' => 'nullable',
            'join_date' => 'required',
            'nepali_join_date' => 'nullable',
            'company_id' => 'required',
            'branch_id' => 'required',
            'department_id' => 'required',
            'designation_id' => 'required',
            'role_id' => 'required',
            'login_id' => 'required',
            'supervisor_id' => 'nullable',
            'status' => 'required',
            'type' => 'required'
        ];
    }
}
