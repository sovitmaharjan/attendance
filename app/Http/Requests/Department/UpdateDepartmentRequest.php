<?php

namespace App\Http\Requests\Department;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDepartmentRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|unique:departments,name,' . $this->route('department')->id,
            'code' => 'nullable|unique:departments,code,' . $this->route('department')->id . '|max:8',
            'address' => 'nullable',
            'email' => 'nullable|email|unique:departments,email,' . $this->route('department')->id,
            'phone' => 'nullable',
            'mobile' => 'nullable',
            'branch_id' => 'required',
        ];
    }
}
