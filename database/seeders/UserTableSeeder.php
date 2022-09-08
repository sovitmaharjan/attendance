<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'tomnjerry',
            'email' => 'tomnjerry8963@gmail.com',
            'password' => bcrypt('1234')
        ]);
    }
}
