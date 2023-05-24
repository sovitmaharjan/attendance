<?php

namespace Database\Seeders;

use App\Models\WorkHour;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WorkHourTableSeeder extends Seeder
{
    public function run()
    {
        WorkHour::create([
            'name' => 'Test Work Hour',
            'in_time' => '09:00',
            'in_time_last' => '09:15',
            'out_time' => '17:00',
            'out_time_last' => '17:15',
            'is_default' => 1,
            'break_time' => '30'
        ]);
    }
}
