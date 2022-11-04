<?php

namespace App\Http\Requests;

use App\Models\LeaveType;
use Illuminate\Foundation\Http\FormRequest;

class LeaveTypeRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => (strtolower(request()->method()) == 'put' || strtolower(request()->method()) == 'patch')
                ? 'required|unique:leave_types,title,' . $this->route('leave_type')->id
                : 'required|unique:leave_types,title,' . LeaveType::where('title', $this->title)->withTrashed()->value('id') ?? null
        ];
    }
}
