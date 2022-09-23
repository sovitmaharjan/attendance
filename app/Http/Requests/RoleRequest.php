<?php

namespace App\Http\Requests;

use App\Models\Role;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RoleRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => (strtolower(request()->method()) == 'put' || strtolower(request()->method()) == 'patch')
                ? 'required|unique:roles,name,' . $this->route('role')->id
                : 'required|unique:roles,name,' . Role::where('name', $this->name)->withTrashed()->value('id') ?? '',
        ];
    }
}
