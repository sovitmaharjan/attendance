<?php

namespace Database\Seeders;

use App\Models\WorkScheduleAssignment;
use Carbon\CarbonPeriod;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class WorkScheduleAssignmentTableSeeder extends Seeder
{
    public function run()
    {
        $dates = CarbonPeriod::create(Carbon::now()->startOfMonth()->format('Y-m-d'), Carbon::now()->endOfMonth()->format('Y-m-d'));
        foreach ($dates as $date) {
            $day = Carbon::parse($date)->format('l');
            WorkScheduleAssignment::updateOrCreate(
                [
                    'employee_id' => 1,
                    'date' => $date
                ],
                [
                    'work_schedule_id' => 1,
                    'day' => $day,
                    'off_day' => in_array($day, ['Saturday'])
                ]
            );
        }
    }
}
