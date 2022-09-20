<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HolidayRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => (strtolower(request()->method()) == 'put' || strtolower(request()->method()) == 'patch')
                ? 'required|unique:holidays,name,' . $this->route('holiday')->id
                : 'required|unique:holidays',
            'date' => 'required',
            'holiday_type_id' => 'required',
            'quantity' => 'required'
        ];
    }
}
