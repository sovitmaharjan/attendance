<?php

namespace Database\Seeders;

use App\Models\Designation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DesignationTableSeeder extends Seeder
{
    public function run()
    {
        Designation::create([
            'title' => 'Admin'
        ]);
    }
}
