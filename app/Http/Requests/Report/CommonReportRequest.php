<?php

namespace App\Http\Requests\Report;

use Illuminate\Foundation\Http\FormRequest;

class CommonReportRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        if((strtolower(request()->method()) == 'post')) {
            return [
                'branch' => 'required',
                'department' => 'required',
                'employee' => 'required',
                'employee_id' => 'required',
                'from_date' => 'required|date|date_format:Y-m-d',
                'to_date' => 'required|date|date_format:Y-m-d|after_or_equal:from_date',
                'nepali_from_date' => 'required|date|date_format:Y-m-d',
                'nepali_to_date' => 'required|date|date_format:Y-m-d|after_or_equal:from_date'
            ];
        } else {
            return [
                //
            ];
        }
    }
}
