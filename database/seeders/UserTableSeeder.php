<?php

namespace Database\Seeders;

use App\Models\Company;
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
            'gender' => 'male',
            'relationship' => 'single',
            'dob' => '1940-02-10',
            'email' => 'tomnjerry8963@gmail.com',
            'company_id' => 1,
            'branch_id' => null,
            'department_id' => null,
            'login_id' => Company::find(1)->code . '-' . $next_id,
            'supervisor_id' => null,
            'password' => bcrypt('123'),
            'login_count' => null,
            'status' => 'Working',
            'type' => 'Permanent'
        ]);
    }
}
