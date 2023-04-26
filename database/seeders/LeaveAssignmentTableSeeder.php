<?php

namespace Database\Seeders;

use App\Models\LeaveAssignment;
use Illuminate\Database\Seeder;

class LeaveAssignmentTableSeeder extends Seeder
{
    public function run()
    {
        LeaveAssignment::create(
            [
                'employee_id' => 1,
                'leave_id' => 1,
                'year' => '2022',
                'allotted_days' => 12,
                'total_remaining_days' => 12
            ]
        );
    }
}
