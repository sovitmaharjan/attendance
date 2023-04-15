<?php

namespace Database\Seeders;

use App\Models\Leave;
use App\Models\LeaveAssignment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LeaveTableSeeder extends Seeder
{
    public function run()
    {
        // leave
        Leave::create([
            'name' => 'Test Leave',
            'allotted_days' => '12',
        ]);
        Leave::create([
            'name' => 'Test Leave 2',
            'allotted_days' => '7',
        ]);

        // leave assignment
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
