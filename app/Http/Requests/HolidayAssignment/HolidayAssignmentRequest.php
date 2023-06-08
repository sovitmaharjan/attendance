<?php

namespace App\Http\Requests\HolidayAssignment;

use Illuminate\Foundation\Http\FormRequest;

class HolidayAssignmentRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        if((strtolower(request()->method()) == 'post')) {
            return [
                'holiday' => 'required',
                'branch' => 'required',
                'department' => 'required'
            ];
        } else {
            return [
                //
            ];
        }
    }
}
