<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AttendanceResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'shift' => $this->shift,

            'in_day' => $this->in_day ?? '',
            'in_date' => $this->in_date ? $this->in_date->format('Y-m-d') : '',
            'in_time' => $this->in_time ?? '',
            'in_mode' => $this->in_mode ?? '',
            'in_remarks' => $this->in_remarks ?? '',

            'out_day' => $this->out_day ?? '',
            'out_date' => $this->out_date ? $this->out_date->format('Y-m-d') : '',
            'out_time' => $this->out_time ?? '',
            'out_mode' => $this->out_mode ?? '',
            'out_remarks' => $this->out_remarks ?? '',

            'in_date_time' => $this->in_date_time ?? '',
            'out_date_time' => $this->out_date_time ?? '',
            'time_difference' => $this->time_difference ?? '',

            'extra' => $this->extra ?? '',
            'created_at' => $this->created_at ? $this->created_at->format('Y-m-d H:i:s') : '',
            'updated_at' => $this->updated_at ? $this->updated_at->format('Y-m-d H:i:s') : ''
        ];
    }
}
