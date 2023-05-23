<?php

namespace Database\Seeders;

use App\Models\WorkScheduleAssignment;
use Carbon\CarbonPeriod;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class AttendanceTableSeeder extends Seeder
{
    public function run()
    {
        // $dates = CarbonPeriod::create(Carbon::now()->startOfMonth()->format('Y-m-d'), Carbon::now()->endOfMonth()->format('Y-m-d'));
        // foreach ($dates as $key => $value) {
        //     $day = Carbon::parse($value)->format('l');
        //     WorkScheduleAssignment::create(
        //         [
        //             'work_schedule_assignment_id' => $key + 1,
        //             'date' => $value,
        //             'day' => $day,
        //             'shift' => 1,
        //             'off_day' => in_array($day, ['Saturday'])
        //         ]
        //     );
        // }
    }
}
