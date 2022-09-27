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

        $department = Department::create([
            'name' => 'Test Department 2',
            'code' => 'TDEP2',
            'address' => 'test departm2ent address',
            'email' => 'testdepartme2nt@email.com',
            'phone' => '+977-0512234554',
            'mobile' => '+977-9822345350',
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

        $department = Department::create([
            'name' => 'Test Department 3',
            'code' => 'TDEP3',
            'address' => 'test departme3nt address',
            'email' => 'testdepart3ment@email.com',
            'phone' => '+977-0513234554',
            'mobile' => '+977-9382345350',
            'company_id' => 1,
            'branch_id' => 2,
        ]);
        $department->status()->updateOrCreate([
            'model_id' => $department->id,
            'model_type' => get_class($department)
        ],
        [
            'status_id' => $status_id ?? 1
        ]);

        $department = Department::create([
            'name' => 'Test Department 4',
            'code' => 'TDEP4',
            'address' => 'test depa4rtment address',
            'email' => 'testdepartm4ent@email.com',
            'phone' => '+977-0512344554',
            'mobile' => '+977-9824345350',
            'company_id' => 1,
            'branch_id' => 2,
        ]);
        $department->status()->updateOrCreate([
            'model_id' => $department->id,
            'model_type' => get_class($department)
        ],
        [
            'status_id' => $status_id ?? 1
        ]);

        $department = Department::create([
            'name' => 'Test Department 5',
            'code' => 'TDEP5',
            'address' => 'test depart5ment address',
            'email' => 'testdepart5ment@email.com',
            'phone' => '+977-0512534554',
            'mobile' => '+977-9825345350',
            'company_id' => 2,
            'branch_id' => 3,
        ]);
        $department->status()->updateOrCreate([
            'model_id' => $department->id,
            'model_type' => get_class($department)
        ],
        [
            'status_id' => $status_id ?? 1
        ]);
        $department = Department::create([
            'name' => 'Test Department 6',
            'code' => 'TDEP6',
            'address' => 'test departm6ent address',
            'email' => 'testdepart6ment@email.com',
            'phone' => '+977-0512364554',
            'mobile' => '+977-9823645350',
            'company_id' => 2,
            'branch_id' => 3,
        ]);
        $department->status()->updateOrCreate([
            'model_id' => $department->id,
            'model_type' => get_class($department)
        ],
        [
            'status_id' => $status_id ?? 1
        ]);

        $department = Department::create([
            'name' => 'Test Department 7',
            'code' => 'TDEP7',
            'address' => 'test departm7ent address',
            'email' => 'testdepartmen7t@email.com',
            'phone' => '+977-0512374554',
            'mobile' => '+977-9823745350',
            'company_id' => 2,
            'branch_id' => 4,
        ]);
        $department->status()->updateOrCreate([
            'model_id' => $department->id,
            'model_type' => get_class($department)
        ],
        [
            'status_id' => $status_id ?? 1
        ]);

        $department = Department::create([
            'name' => 'Test Department 8',
            'code' => 'TDEP8',
            'address' => 'test d8epartment address',
            'email' => 'testdepartm8ent@email.com',
            'phone' => '+977-0512834554',
            'mobile' => '+977-9828345350',
            'company_id' => 2,
            'branch_id' => 4,
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
