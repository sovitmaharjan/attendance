<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(AttendanceFunctionSeeder::class);
        $this->call(BranchTableSeeder::class);
        $this->call(DepartmentTableSeeder::class);
        $this->call(DesignationTableSeeder::class);
        $this->call(PermissionGroupTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(ShiftTableSeeder::class);
        $this->call(WorkScheduleTableSeeder::class);
        $this->call(ShiftAssignmentTableSeeder::class);
        $this->call(HolidayTableSeeder::class);
        $this->call(LeaveTableSeeder::class);
        $this->call(LeaveAssignmentTableSeeder::class);
        $this->call(LeaveApplicationTableSeeder::class);
        $this->call(DynamicValueTableSeeder::class);
    }
}
