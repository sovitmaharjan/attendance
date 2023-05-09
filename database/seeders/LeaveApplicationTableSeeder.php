<?php

namespace Database\Seeders;

use App\Models\LeaveApplication;
use App\Models\LeaveAssignment;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class LeaveApplicationTableSeeder extends Seeder
{
    public function run()
    {
        $difference = Carbon::parse('2022-11-17')->diffInDays(Carbon::parse('2022-11-17'));
        $leave_application = LeaveApplication::create([
            'leave_id' => 1,
            'employee_id' => 1,
            'from_date' => '2022-11-17',
            'to_date' => '2022-11-17',
            'year' => '2022',
            'leave_duration' => $difference + 1,
            'description' => 'headache',
            'status' => LeaveApplication::APPROVED,
            'extra' => [
                'nepali_from_date' => '2079-08-01',
                'nepali_to_date' => '2079-08-01'
            ]
        ]);
        for ($i = 0; $i <= $difference; $i++) {
            $leave_application->leave_application_dates()->create([
                'date' => Carbon::parse('2022-11-17')->addDays($i)
            ]);
        }
        LeaveAssignment::where([
            'leave_id' => 1,
            'employee_id' => 1
        ])->decrement('total_remaining_days', $difference + 1);

        $difference = Carbon::parse('2022-12-17')->diffInDays(Carbon::parse('2022-12-17'));
        $leave_application = LeaveApplication::create([
            'leave_id' => 1,
            'employee_id' => 1,
            'from_date' => '2022-12-17',
            'to_date' => '2022-12-17',
            'year' => '2022',
            'leave_duration' => $difference + 1,
            'description' => '-',
            'status' => LeaveApplication::CANCELLED,
            'extra' => [
                'nepali_from_date' => '2079-09-02',
                'nepali_to_date' => '2079-09-02'
            ]
        ]);

        $difference = Carbon::parse('2022-12-20')->diffInDays(Carbon::parse('2022-12-20'));
        $leave_application = LeaveApplication::create([
            'leave_id' => 1,
            'employee_id' => 1,
            'from_date' => '2022-12-20',
            'to_date' => '2022-12-20',
            'year' => '2022',
            'leave_duration' => $difference + 1,
            'description' => 'party',
            'status' => 'pending',
            'extra' => [
                'nepali_from_date' => '2079-09-05',
                'nepali_to_date' => '2079-09-05'
            ]
        ]);
    }
}
