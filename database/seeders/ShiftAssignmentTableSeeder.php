<?php

namespace Database\Seeders;

use App\Models\DepartmentOffDaysTrack;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShiftAssignmentTableSeeder extends Seeder
{
    public function run()
    {
        DepartmentOffDaysTrack::create([
            'department_id' => 1,
            'days' => ['Sunday', 'Saturday'],
            'date' => date('y-m-d'),
            'date_time' => date('Y-m-d h:i:s')
        ]);
        
        DB::table('shift_assignments')->insert([
            [
                'shift_id' => '1',
                'employee_id' => '1',
                'in_time' => '09:00:00',
                'out_time' => '18:00:00',
                'date' => '2022-11-01', // Tuesday, exact in time, exact out time
                'extra' => '{"nepali_from_date":"2079-07-15","nepali_to_date":"2079-08-14"}',
                'created_at' => '2022-11-24 14:10:12',
                'updated_at' => '2022-11-24 14:23:51'
            ],
            [
                'shift_id' => '1',
                'employee_id' => '1',
                'in_time' => '09:00:00',
                'out_time' => '17:30:00',
                'date' => '2022-11-02', // Wednesday, exact in time, early out time
                'extra' => '{"nepali_from_date":"2079-07-15","nepali_to_date":"2079-08-14"}',
                'created_at' => '2022-11-24 14:10:12',
                'updated_at' => '2022-11-24 14:23:51'
            ],
            [
                'shift_id' => '1',
                'employee_id' => '1',
                'in_time' => '09:00:00',
                'out_time' => '18:30:00',
                'date' => '2022-11-03', // Thursday, exact in time, late out time
                'extra' => '{"nepali_from_date":"2079-07-15","nepali_to_date":"2079-08-14"}',
                'created_at' => '2022-11-24 14:10:12',
                'updated_at' => '2022-11-24 14:23:51'
            ],
            [
                'shift_id' => '1',
                'employee_id' => '1',
                'in_time' => '08:30:00',
                'out_time' => '18:00:00',
                'date' => '2022-11-04', // Friday, early in time, exact out time
                'extra' => '{"nepali_from_date":"2079-07-15","nepali_to_date":"2079-08-14"}',
                'created_at' => '2022-11-24 14:10:12',
                'updated_at' => '2022-11-24 14:23:51'
            ],
            [
                'shift_id' => '1',
                'employee_id' => '1',
                'in_time' => NULL,
                'out_time' => NULL,
                'date' => '2022-11-05', // Saturday, off day
                'extra' => '{"nepali_from_date":"2079-07-15","nepali_to_date":"2079-08-14"}',
                'created_at' => '2022-11-24 14:10:12',
                'updated_at' => '2022-11-24 14:23:51'
            ],
            [
                'shift_id' => '1',
                'employee_id' => '1',
                'in_time' => '09:00:00',
                'out_time' => '18:00:00',
                'date' => '2022-11-06', //Sunday, exact in time, exact out time
                'extra' => '{"nepali_from_date":"2079-07-15","nepali_to_date":"2079-08-14"}',
                'created_at' => '2022-11-24 14:10:12',
                'updated_at' => '2022-11-24 14:23:51'
            ],
            [
                'shift_id' => '1',
                'employee_id' => '1',
                'in_time' => '08:30:00',
                'out_time' => '17:30:00',
                'date' => '2022-11-07', // Monday, early in time, early out time
                'extra' => '{"nepali_from_date":"2079-07-15","nepali_to_date":"2079-08-14"}',
                'created_at' => '2022-11-24 14:10:12',
                'updated_at' => '2022-11-24 14:23:51'
            ],
            [
                'shift_id' => '1',
                'employee_id' => '1',
                'in_time' => '08:30:00',
                'out_time' => '18:30:00',
                'date' => '2022-11-08', // Tuesday, early in time, late out time
                'extra' => '{"nepali_from_date":"2079-07-15","nepali_to_date":"2079-08-14"}',
                'created_at' => '2022-11-24 14:10:12',
                'updated_at' => '2022-11-24 14:23:51'
            ],
            [
                'shift_id' => '1',
                'employee_id' => '1',
                'in_time' => '09:30:00',
                'out_time' => '18:00:00',
                'date' => '2022-11-09', // Wednesday, late in time, exact out time
                'extra' => '{"nepali_from_date":"2079-07-15","nepali_to_date":"2079-08-14"}',
                'created_at' => '2022-11-24 14:10:12',
                'updated_at' => '2022-11-24 14:23:51'
            ],
            [
                'shift_id' => '1',
                'employee_id' => '1',
                'in_time' => '09:30:00',
                'out_time' => '17:30:00',
                'date' => '2022-11-10', // Thursday, late in time, early out time
                'extra' => '{"nepali_from_date":"2079-07-15","nepali_to_date":"2079-08-14"}',
                'created_at' => '2022-11-24 14:10:12',
                'updated_at' => '2022-11-24 14:23:51'
            ],
            [
                'shift_id' => '1',
                'employee_id' => '1',
                'in_time' => '09:30:00',
                'out_time' => '18:30:00',
                'date' => '2022-11-11', // Friday, late in time, late out time
                'extra' => '{"nepali_from_date":"2079-07-15","nepali_to_date":"2079-08-14"}',
                'created_at' => '2022-11-24 14:10:12',
                'updated_at' => '2022-11-24 14:23:51'
            ],
            [
                'shift_id' => '1',
                'employee_id' => '1',
                'in_time' => NULL,
                'out_time' => NULL,
                'date' => '2022-11-12', // Saturday, off day
                'extra' => '{"nepali_from_date":"2079-07-15","nepali_to_date":"2079-08-14"}',
                'created_at' => '2022-11-24 14:10:12',
                'updated_at' => '2022-11-24 14:23:51'
            ],
            [
                'shift_id' => '1',
                'employee_id' => '1',
                'in_time' => NULL,
                'out_time' => NULL,
                'date' => '2022-11-13', // Saturday, off day
                'extra' => '{"nepali_from_date":"2079-07-15","nepali_to_date":"2079-08-14"}',
                'created_at' => '2022-11-24 14:10:12',
                'updated_at' => '2022-11-24 14:23:51'
            ],
            [
                'shift_id' => '1',
                'employee_id' => '1',
                'in_time' => NULL,
                'out_time' => '18:00:00',
                'date' => '2022-11-14', // Monday, missing in time
                'extra' => '{"nepali_from_date":"2079-07-15","nepali_to_date":"2079-08-14"}',
                'created_at' => '2022-11-24 14:10:12',
                'updated_at' => '2022-11-24 14:23:51'
            ],
            [
                'shift_id' => '1',
                'employee_id' => '1',
                'in_time' => '09:00:00',
                'out_time' => NULL,
                'date' => '2022-11-15', // Tuesday, missing out time
                'extra' => '{"nepali_from_date":"2079-07-15","nepali_to_date":"2079-08-14"}',
                'created_at' => '2022-11-24 14:10:12',
                'updated_at' => '2022-11-24 14:23:51'
            ],
            [
                'shift_id' => '1',
                'employee_id' => '1',
                'in_time' => NULL,
                'out_time' => NULL,
                'date' => '2022-11-16', // Wednesday, absent
                'extra' => '{"nepali_from_date":"2079-07-15","nepali_to_date":"2079-08-14"}',
                'created_at' => '2022-11-24 14:10:12',
                'updated_at' => '2022-11-24 14:23:51'
            ],
            [
                'shift_id' => '1',
                'employee_id' => '1',
                'in_time' => NULL,
                'out_time' => NULL,
                'date' => '2022-11-17', // Thursday, leave
                'extra' => '{"nepali_from_date":"2079-07-15","nepali_to_date":"2079-08-14"}',
                'created_at' => '2022-11-24 14:10:12',
                'updated_at' => '2022-11-24 14:23:51'
            ],
            [
                'shift_id' => '1',
                'employee_id' => '1',
                'in_time' => '09:30:00',
                'out_time' => '18:30:00',
                'date' => '2022-11-18', // Friday, holiday
                'extra' => '{"nepali_from_date":"2079-07-15","nepali_to_date":"2079-08-14"}',
                'created_at' => '2022-11-24 14:10:12',
                'updated_at' => '2022-11-24 14:23:51'
            ],
            [
                'shift_id' => '1',
                'employee_id' => '1',
                'in_time' => NULL,
                'out_time' => NULL,
                'date' => '2022-11-19', // Saturday, off day
                'extra' => '{"nepali_from_date":"2079-07-15","nepali_to_date":"2079-08-14"}',
                'created_at' => '2022-11-24 14:10:12',
                'updated_at' => '2022-11-24 14:23:51'
            ],
            [
                'shift_id' => '1',
                'employee_id' => '1',
                'in_time' => NULL,
                'out_time' => NULL,
                'date' => '2022-11-20', // Saturday, off day
                'extra' => '{"nepali_from_date":"2079-07-15","nepali_to_date":"2079-08-14"}',
                'created_at' => '2022-11-24 14:10:12',
                'updated_at' => '2022-11-24 14:23:51'
            ]
        ]);
    }
}
