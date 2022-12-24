<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShiftAssignmentTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('shift_assignments')->insert([
            [
                'shift_id' => '1',
                'employee_id' => '1',
                'in_time' => '09:00:00',
                'out_time' => '18:00:00',
                'date' => '2022-11-01 00:00:00',
                'extra' => '{"nep_from_date":"2079-07-15","nep_to_date":"2079-08-14"}',
                'created_at' => '2022-11-24 14:10:12',
                'updated_at' => '2022-11-24 14:23:51'
            ],
            [
                'shift_id' => '1',
                'employee_id' => '1',
                'in_time' => '09:00:00',
                'out_time' => '17:30:00',
                'date' => '2022-11-02 00:00:00',
                'extra' => '{"nep_from_date":"2079-07-15","nep_to_date":"2079-08-14"}',
                'created_at' => '2022-11-24 14:10:12',
                'updated_at' => '2022-11-24 14:23:51'
            ],
            [
                'shift_id' => '1',
                'employee_id' => '1',
                'in_time' => '09:00:00',
                'out_time' => '18:30:00',
                'date' => '2022-11-03 00:00:00',
                'extra' => '{"nep_from_date":"2079-07-15","nep_to_date":"2079-08-14"}',
                'created_at' => '2022-11-24 14:10:12',
                'updated_at' => '2022-11-24 14:23:51'
            ],
            [
                'shift_id' => '1',
                'employee_id' => '1',
                'in_time' => '08:30:00',
                'out_time' => '18:00:00',
                'date' => '2022-11-04 00:00:00',
                'extra' => '{"nep_from_date":"2079-07-15","nep_to_date":"2079-08-14"}',
                'created_at' => '2022-11-24 14:10:12',
                'updated_at' => '2022-11-24 14:23:51'
            ],
            [
                'shift_id' => '1',
                'employee_id' => '1',
                'in_time' => '08:30:00',
                'out_time' => '17:30:00',
                'date' => '2022-11-05 00:00:00',
                'extra' => '{"nep_from_date":"2079-07-15","nep_to_date":"2079-08-14"}',
                'created_at' => '2022-11-24 14:10:12',
                'updated_at' => '2022-11-24 14:23:51'
            ],
            [
                'shift_id' => '1',
                'employee_id' => '1',
                'in_time' => '08:30:00',
                'out_time' => '18:30:00',
                'date' => '2022-11-06 00:00:00',
                'extra' => '{"nep_from_date":"2079-07-15","nep_to_date":"2079-08-14"}',
                'created_at' => '2022-11-24 14:10:12',
                'updated_at' => '2022-11-24 14:23:51'
            ],
            [
                'shift_id' => '1',
                'employee_id' => '1',
                'in_time' => '09:30:00',
                'out_time' => '18:00:00',
                'date' => '2022-11-07 00:00:00',
                'extra' => '{"nep_from_date":"2079-07-15","nep_to_date":"2079-08-14"}',
                'created_at' => '2022-11-24 14:10:12',
                'updated_at' => '2022-11-24 14:23:51'
            ],
            [
                'shift_id' => '1',
                'employee_id' => '1',
                'in_time' => '09:30:00',
                'out_time' => '17:30:00',
                'date' => '2022-11-08 00:00:00',
                'extra' => '{"nep_from_date":"2079-07-15","nep_to_date":"2079-08-14"}',
                'created_at' => '2022-11-24 14:10:12',
                'updated_at' => '2022-11-24 14:23:51'
            ],
            [
                'shift_id' => '1',
                'employee_id' => '1',
                'in_time' => '09:30:00',
                'out_time' => '18:30:00',
                'date' => '2022-11-09 00:00:00',
                'extra' => '{"nep_from_date":"2079-07-15","nep_to_date":"2079-08-14"}',
                'created_at' => '2022-11-24 14:10:12',
                'updated_at' => '2022-11-24 14:23:51'
            ]
        ]);
    }
}
