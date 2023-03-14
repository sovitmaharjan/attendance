<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // sql function
        DB::unprepared("
            DROP FUNCTION IF EXISTS get_attendance;
            CREATE FUNCTION `get_attendance`(in_time TIME, out_time TIME) RETURNS varchar(20) CHARSET utf8mb4
                DETERMINISTIC
            BEGIN
                IF in_time is not null && out_time is not null THEN
                    RETURN 'present';
                END IF;
                IF in_time is null && out_time is null THEN
                    RETURN 'absent';
                END IF;
                IF in_time is null && out_time is not null THEN
                    RETURN 'missing_in_time';
                END IF;
                IF in_time is not null && out_time is null THEN
                    RETURN 'missing_out_time';
                END IF;
            END
        ");
        $this->call(BranchTableSeeder::class);
        $this->call(DepartmentTableSeeder::class);
        $this->call(DesignationTableSeeder::class);
        $this->call(PermissionGroupTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(ShiftTableSeeder::class);
        $this->call(ShiftAssignmentTableSeeder::class);
        $this->call(HolidayTableSeeder::class);
        $this->call(LeaveTableSeeder::class);
        $this->call(DynamicValueTableSeeder::class);
    }
}
