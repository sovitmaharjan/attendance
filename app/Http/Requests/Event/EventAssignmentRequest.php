<?php

namespace App\Http\Requests\Event;

use Illuminate\Foundation\Http\FormRequest;

class EventAssignmentRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {

        return [
            'event_id' => ['required'],
            'employee_id' => ['required'],
            'employee_id.*' => ['required', 'distinct'],
        ];
    }

    public function messages()
    {
        return [
            'event_id.required' => 'The event field is required.',
            'employee_id.required' => 'The employee field is required.'
        ];
    }
}
