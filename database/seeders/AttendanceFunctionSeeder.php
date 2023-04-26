<?php

namespace Database\Seeders;

use App\Models\ForceAttendance;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AttendanceFunctionSeeder extends Seeder
{
    public function run()
    {
        DB::unprepared("
            DROP FUNCTION IF EXISTS attendance_status;
            CREATE FUNCTION `attendance_status`(in_time TIME, out_time TIME) RETURNS varchar(20) CHARSET utf8mb4
                DETERMINISTIC
            BEGIN
                IF in_time is not null && out_time is not null THEN
                    RETURN '". ForceAttendance::PRESENT_MESSAGE ."';
                END IF;
                IF in_time is null && out_time is null THEN
                    RETURN '". ForceAttendance::ABSENT_MESSAGE ."';
                END IF;
                IF in_time is null && out_time is not null THEN
                    RETURN '". ForceAttendance::IN_TIME_MESSAGE ."';
                END IF;
                IF in_time is not null && out_time is null THEN
                    RETURN '". ForceAttendance::OUT_TIME_MESSAGE ."';
                END IF;
            END
        ");
    }
}
