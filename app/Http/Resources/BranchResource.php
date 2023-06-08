<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BranchResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'code' => $this->code,
            'address' => $this->address,
            'email' => $this->email,
            'phone' => $this->phone,
            'mobile' => $this->mobile,
            'status' => $this->status,
            'departments' => DepartmentResource::collection($this->whenLoaded('departments')),
            'employees' => EmployeeResource::collection($this->whenLoaded('employees')),
        ];
    }
}
