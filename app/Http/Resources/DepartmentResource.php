<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DepartmentResource extends JsonResource
{
    public function toArray($request)
    {
        return parent::toArray($request);
        return [
            'id' => $this->id,
            'name' => $this->name,
            'code' => $this->code,
            'address' => $this->address,
            'email' => $this->email,
            'phone' => $this->phone,
            'mobile' => $this->mobile,
            'branch_id' => $this->branch_id,
            'status' => $this->status,
            'employees' => EmployeeResource::collection($this->whenLoaded('employees')),
        ];
    }
}
