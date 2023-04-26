<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;

class DepartmentTableSeeder extends Seeder
{
    public function run()
    {
        Department::create([
            'name' => 'Test Branch 1 Department 1',
            'code' => 'TB1DEP',
            'address' => 'test department address',
            'email' => 'testdepartment@email.com',
            'phone' => '+977-051234554',
            'mobile' => '+977-982345350',
            'status' => 1,
            'branch_id' => 1,
        ]);
        Department::create([
            'name' => 'Test Branch 1 Department 2',
            'code' => 'TB1DEP2',
            'address' => 'test departm2ent address',
            'email' => 'testdepartme2nt@email.com',
            'phone' => '+977-0512234554',
            'mobile' => '+977-9822345350',
            'status' => 1,
            'branch_id' => 1,
        ]);
        Department::create([
            'name' => 'Test Branch 2 Department 3',
            'code' => 'TB2DEP3',
            'address' => 'test departme3nt address',
            'email' => 'testdepart3ment@email.com',
            'phone' => '+977-0513234554',
            'mobile' => '+977-9382345350',
            'status' => 1,
            'branch_id' => 2,
        ]);
        Department::create([
            'name' => 'Test Branch 2 Department 4',
            'code' => 'TB2DEP4',
            'address' => 'test depa4rtment address',
            'email' => 'testdepartm4ent@email.com',
            'phone' => '+977-0512344554',
            'mobile' => '+977-9824345350',
            'status' => 1,
            'branch_id' => 2,
        ]);
        Department::create([
            'name' => 'Test Branch 3 Department 5',
            'code' => 'TB3DEP5',
            'address' => 'test depart5ment address',
            'email' => 'testdepart5ment@email.com',
            'phone' => '+977-0512534554',
            'mobile' => '+977-9825345350',
            'status' => 1,
            'branch_id' => 3,
        ]);
        Department::create([
            'name' => 'Test Branch 3 Department 6',
            'code' => 'TB3DEP6',
            'address' => 'test departm6ent address',
            'email' => 'testdepart6ment@email.com',
            'phone' => '+977-0512364554',
            'mobile' => '+977-9823645350',
            'status' => 1,
            'branch_id' => 3,
        ]);
        Department::create([
            'name' => 'Test Branch 4 Department 7',
            'code' => 'TB4DEP7',
            'address' => 'test departm7ent address',
            'email' => 'testdepartmen7t@email.com',
            'phone' => '+977-0512374554',
            'mobile' => '+977-9823745350',
            'status' => 1,
            'branch_id' => 4,
        ]);
        Department::create([
            'name' => 'Test Branch 4 Department 8',
            'code' => 'TB4DEP8',
            'address' => 'test d8epartment address',
            'email' => 'testdepartm8ent@email.com',
            'phone' => '+977-0512834554',
            'mobile' => '+977-9828345350',
            'status' => 1,
            'branch_id' => 4,
        ]);
    }
}
