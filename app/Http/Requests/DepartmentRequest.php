<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DepartmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name'=>'required|unique:departments,name',
            'code'=>'required|unique:departments,code|max:8',
            'address'=>'required',
            'email'=>'required|email|unique:departments,email',
            'phone'=>'required|digits:10|numeric',
            'mobile'=>'sometimes',
            'branch_id'=>'required',
        ];
    }
}
