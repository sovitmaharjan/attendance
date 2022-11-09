<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(StatusTableSeeder::class);
        $this->call(CompanyTableSeeder::class);
        $this->call(BranchTableSeeder::class);
        $this->call(DepartmentTableSeeder::class);
        $this->call(DesignationTableSeeder::class);
        $this->call(PermissionGroupTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(ShiftTableSeeder::class);
        $this->call(HolidayTableSeeder::class);
        $this->call(LeaveTableSeeder::class);
    }
}
