<?php

namespace Database\Seeders;

use App\Models\Branch;
use App\Models\Company;
use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentTableSeeder extends Seeder
{
    public function run()
    {
        $department = Department::create([
            'name' => 'Test Department',
            'code' => 'TDEP',
            'address' => 'test department address',
            'email' => 'testdepartment@email.com',
            'phone' => '+977-051234554',
            'mobile' => '+977-982345350',
            'company_id' => 1,
            'branch_id' => 1,
        ]);
        $department->status()->updateOrCreate([
            'model_id' => $department->id,
            'model_type' => get_class($department)
        ],
        [
            'status_id' => $status_id ?? 1
        ]);
    }
}
