<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Designation;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    public function run()
    {
        $next_id = User::latest()->first() != false ? User::latest()->first()->id + 1 : 1;
        User::create([
            'prefix' => 'Mr.',
            'firstname' => 'Tom',
            'middlename' => 'n',
            'lastname' => 'jerry',
            'email' => 'tomnjerry8963@gmail.com',
            'phone' => '+977-986543221',
            'address' => 'address',
            'gender' => 'male',
            'marital_status' => 'Married',
            'dob' => '1940-02-10',
            'join_date' => '2022-01-01',
            'company_id' => Company::find(1)->id,
            'branch_id' => null,
            'department_id' => null,
            'designation_id' => Designation::find(1)->id,
            'login_id' => Company::find(1)->code . '-' . $next_id,
            'supervisor' => null,
            'password' => bcrypt('123'),
            'login_count' => null,
            'status' => 'Working',
            'type' => 'Permanent'
        ]);
    }
}
