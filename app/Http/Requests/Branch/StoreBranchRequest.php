<?php

namespace App\Http\Requests\Branch;

use Illuminate\Foundation\Http\FormRequest;

class StoreBranchRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|unique:branches,name',
            'code' => 'nullable|unique:branches,code|max:8',
            'address' => 'nullable',
            'email' => 'nullable|email|unique:branches,email',
            'phone' => 'nullable|digits:10|numeric',
            'mobile' => 'nullable',
        ];
    }
}
