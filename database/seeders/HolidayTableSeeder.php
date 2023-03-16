<?php

namespace Database\Seeders;

use App\Models\Holiday;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HolidayTableSeeder extends Seeder
{
    public function run()
    {
        $holiday = Holiday::create([
            'name' => 'test holiday 1',
            'from_date' => '2022-11-18',
            'to_date' => '2022-11-18',
            'quantity' => 1,
            'extra' => [
                'nepali_from_date' => '2079-08-02',
                'nepali_to_date' => '2079-08-02'
            ]
        ]);
        $holiday->holiday_dates()->create([
            'date' => '2022-11-18'
        ]);
    }
}
