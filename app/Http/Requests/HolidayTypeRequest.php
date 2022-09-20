<?php

namespace App\Http\Requests;

use App\Models\HolidayType;
use Illuminate\Foundation\Http\FormRequest;

class HolidayTypeRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => (strtolower(request()->method()) == 'put' || strtolower(request()->method()) == 'patch')
                ? 'required|unique:holiday_types,title,' . $this->route('holiday_type')->id
                : 'required|unique:holiday_types,title,' . HolidayType::where('title', $this->title)->withTrashed()->value('id') ?? null
        ];
    }
}
