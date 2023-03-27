<?php

namespace Database\Seeders;

use App\Models\Leave;
use App\Models\LeaveApplication;
use App\Models\LeaveAssignment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class LeaveTableSeeder extends Seeder
{
    public function run()
    {
        // leave
        $leave = Leave::create([
            'name' => 'Test Leave',
            'allotted_days' => '12',
        ]);

        // leave assignment
        $leave_assignment = LeaveAssignment::updateOrCreate(
            [
                'leave_id' => $leave->id,
                'employee_id' => 1,
                'year' => '2022',
            ],
            [
                'allotted_days' => 12
            ]
        );
        $leave_assignment->remaining_days()->updateOrCreate(
            [
                'leave_assignment_id' => $leave_assignment->id
            ],
            [
                'remaining_days' => 12
            ]
        );
        $leave_assignment = LeaveAssignment::updateOrCreate(
            [
                'leave_id' => $leave->id,
                'employee_id' => 1,
                'year' => date('Y'),
            ],
            [
                'allotted_days' => 12,
            ]
        );
        $leave_assignment->remaining_days()->updateOrCreate(
            [
                'leave_assignment_id' => $leave_assignment->id
            ],
            [
                'remaining_days' => 12
            ]
        );
        // $difference = Carbon::parse('2022-11-17')->diffInDays(Carbon::parse('2022-11-17'));
        // $data = [
        //     'leave_id' => 1,
        //     'employee_id' => 1,
        //     'from_date' => '2022-11-17',
        //     'to_date' => '2022-11-17',
        //     'year' => '2022',
        //     'leave_days_count' => $difference + 1,
        //     'employee_id' => 1,
        // ];
        // $data['leave_days_count'] = $difference + 1;
        // $leave_application = LeaveApplication::create($data);
        // for ($i = 0; $i <= $difference; $i++) {
        //     $leave_application->leave_application_dates()->create([
        //         'date' => Carbon::parse('2022-11-17')->addDays($i)
        //     ]);
        // }
        // $leave_assignment->remaining_days()->where('leave_assignment_id', $leave_assignment->id)->decrement('remaining_days', $difference + 1);
    }
}
