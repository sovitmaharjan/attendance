<?php

namespace App\Http\Requests\HolidayAssignment;

use Illuminate\Foundation\Http\FormRequest;

class StoreHolidayAssignmentRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            // validation will be done after workflow is done
        ];
    }
}
