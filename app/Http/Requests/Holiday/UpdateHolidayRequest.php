<?php

namespace App\Http\Requests\Holiday;

use Illuminate\Foundation\Http\FormRequest;

class UpdateHolidayRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|unique:holidays,name,' . $this->route('holiday')->id,
            'from_date' => 'required|date',
            'to_date' => 'required|date|after_or_equal:from_date',
            'nep_from_date' => 'nullable|date|date_format:Y-m-d',
            'nep_to_date' => 'nullable|date|date_format:Y-m-d|after_or_equal:from_date'
        ];
    }
}
