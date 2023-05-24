<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeWorkHourResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'work_hour' => $this->workHour,
            'assigned_date' => $this->assigned_date ? $this->assigned_date->format('Y-m-d') : '',
            'assigned_day' => $this->assigned_date ? $this->assigned_date->format('l') : '',
            'extra' => $this->extra,
            'created_at' => $this->created_at ? $this->created_at->format('Y-m-d H:i:s') : '',
            'updated_at' => $this->updated_at ? $this->updated_at->format('Y-m-d H:i:s') : '',
            'attendances' => AttendanceResource::collection($this->attendances)
        ];
    }
}
