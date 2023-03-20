<?php

namespace App\Http\Requests\Department;

use Illuminate\Foundation\Http\FormRequest;

class StoreDepartmentRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|unique:departments,name',
            'code' => 'nullable|unique:departments,code|max:8',
            'address' => 'nullable',
            'email' => 'nullable|email|unique:departments,email',
            'phone' => 'nullable',
            'mobile' => 'nullable',
            'branch_id' => 'required',
        ];
    }
}
