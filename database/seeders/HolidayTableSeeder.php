<?php

namespace Database\Seeders;

use App\Models\Holiday;
use App\Models\HolidayType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HolidayTableSeeder extends Seeder
{
    public function run()
    {
        Holiday::create([
            'name' => 'test holiday 1',
            'date' => '2022-04-04',
            'holiday_type_id' => HolidayType::find(1)->id,
            'quantity' => 1
        ]);
    }
}
