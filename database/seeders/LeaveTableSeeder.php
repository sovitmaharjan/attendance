<?php

namespace Database\Seeders;

use App\Models\Leave;
use Illuminate\Database\Seeder;

class LeaveTableSeeder extends Seeder
{
    public function run()
    {
        Leave::create([
            'name' => 'Test Leave',
            'allotted_days' => '12',
        ]);
        Leave::create([
            'name' => 'Test Leave 2',
            'allotted_days' => '7',
        ]);
    }
}
