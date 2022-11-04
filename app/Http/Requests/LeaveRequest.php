<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LeaveRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => (strtolower(request()->method()) == 'put' || strtolower(request()->method()) == 'patch')
                ? 'required|unique:leaves,name,' . $this->route('leave')->id
                : 'required|unique:leaves',
            'leave_type_id' => 'nullable',
            'days_allowed' => 'required'
        ];
    }
}
