<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
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
            'title' => ['required'],
            'slug' => ['nullable'],
            'from_date' => ['required', 'date'],
            'to_date' => ['required', 'date'],
            'nepali_from_date' => ['required', 'date'],
            'nepali_to_date' => ['required', 'date'],
        ];
    }
}
