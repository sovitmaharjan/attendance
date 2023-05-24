<?php

namespace Database\Seeders;

use App\Models\WorkHourAssignment;
use Carbon\CarbonPeriod;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class WorkHourAssignmentTableSeeder extends Seeder
{
    public function run()
    {
        $dates = CarbonPeriod::create(Carbon::now()->startOfMonth()->format('Y-m-d'), Carbon::now()->endOfMonth()->format('Y-m-d'));
        foreach ($dates as $date) {
            $day = Carbon::parse($date)->format('l');
            WorkHourAssignment::updateOrCreate(
                [
                    'employee_id' => 1,
                    'assigned_date' => $date
                ],
                [
                    'work_hour_id' => 1,
                    'assigned_day' => $day,
                    'off_day' => in_array($day, ['Saturday'])
                ]
            );
        }
    }
}
