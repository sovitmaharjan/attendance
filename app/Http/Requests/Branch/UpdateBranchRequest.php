<?php

namespace App\Http\Requests\Branch;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBranchRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|unique:branches,name,' . $this->route('branch')->id,
            'code' => 'nullable|unique:branches,code,' . $this->route('branch')->id . '|max:8',
            'address' => 'nullable',
            'email' => 'nullable|email|unique:branches,email,' . $this->route('branch')->id,
            'phone' => 'nullable|digits:10|numeric',
            'mobile' => 'nullable',
        ];
    }
}
