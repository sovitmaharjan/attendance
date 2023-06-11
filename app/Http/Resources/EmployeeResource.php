<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'login_id' => $this->login_id,
            'prefix' => $this->prefix,
            'firstname' => $this->firstname,
            'middlename' => $this->middlename,
            'lastname' => $this->lastname,
            'full_name' => $this->full_name,
            'gender' => $this->gender,
            'marital_status' => $this->marital_status,
            'dob' => $this->dob,
            'join_date' => $this->join_date,
            'phone' => $this->phone,
            'address' => $this->address,
            'citizenship_number' => $this->citizenship_number,
            'pan_number' => $this->pan_number,
            'email' => $this->email,
            'branch_id' => $this->branch_id,
            'department_id' => $this->department_id,
            'designation_id' => $this->designation_id,
            'role_id' => $this->role_id,
            'supervisor_id' => $this->supervisor_id,
            'login_count' => $this->login_count,
            'status' => $this->status,
            'type' => $this->type,
            'official_email' => $this->official_email,
        ];
    }
}
