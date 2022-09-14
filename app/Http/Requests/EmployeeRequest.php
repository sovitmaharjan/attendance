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
            'gender' => 'required',
            'relationship' => 'required',
            'dob' => 'required',
            'email' => 'required',
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
