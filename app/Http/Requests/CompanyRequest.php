<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
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
            'name'=>'required|unique:companies,name',
            'code'=>'required|unique:companies,code',
            'address'=>'required',
            'email'=>'required|email|unique:companies,email',
            'phone'=>'required|digits:10|numeric',
            'mobile'=>'sometimes|numeric',
            'website'=>'required'
        ];
    }
}
