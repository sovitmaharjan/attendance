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
            'branch_id' => 'nullable',
            'department_id' => 'nullable',
            'login_id' => 'required',
            'supervisor' => 'nullable',
            'status' => 'required',
            'type' => 'required'
        ];
    }
}