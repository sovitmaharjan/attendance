<?php

namespace Database\Seeders;

use App\Models\Holiday;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HolidayTableSeeder extends Seeder
{
    public function run()
    {
        Holiday::create([
            'name' => 'test holiday 1',
            'date' => '2022-04-04',
            'quantity' => 1
        ]);
    }
}
