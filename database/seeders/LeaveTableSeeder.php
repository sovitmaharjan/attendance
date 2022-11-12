<?php

namespace Database\Seeders;

use App\Models\Leave;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LeaveTableSeeder extends Seeder
{
    public function run()
    {
        Leave::create([
            'name' => 'Test Leave',
            'allowed_days' => '12',
        ]);
    }
}
