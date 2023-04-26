<?php

namespace Database\Seeders;

use App\Models\Shift;
use Illuminate\Database\Seeder;

class ShiftTableSeeder extends Seeder
{
    public function run()
    {
        Shift::create([
            'name' => 'Test Shift',
            'in_time' => '09:00',
            'in_time_last' => '09:15',
            'out_time' => '18:00',
            'out_time_last' => '18:15',
            'break_time' => '30'
        ]);
    }
}
