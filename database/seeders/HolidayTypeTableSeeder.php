<?php

namespace Database\Seeders;

use App\Models\HolidayType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HolidayTypeTableSeeder extends Seeder
{
    public function run()
    {
        HolidayType::create([
            'title' => 'test holiday type 1'
        ]);
    }
}
