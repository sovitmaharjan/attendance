<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Designation;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    public function run()
    {
        $next_id = User::orderBy('id', 'desc')->first() != false ? User::orderBy('id', 'desc')->first()->id + 1 : 1;
        User::create([
            'prefix' => 'Mr.',
            'firstname' => 'Tom',
            'middlename' => 'n',
            'lastname' => 'jerry',
            'email' => 'tomnjerry8963@gmail.com',
            'phone' => '+977-986543221',
            'address' => 'address',
            'gender' => 'male',
            'marital_status' => 'Unmarried',
            'dob' => '1940-02-10',
            'join_date' => '2022-01-01',
            'branch_id' => 1,
            'department_id' => 1,
            'designation_id' => Designation::find(1)->id,
            'login_id' => 'superadmin',
            'supervisor_id' => null,
            'password' => bcrypt('123'),
            'login_count' => 0,
            'status' => 'Working',
            'type' => 'Permanent',
            'role_id' => 1,
        ]);

        User::factory(10)->create();
    }
}
