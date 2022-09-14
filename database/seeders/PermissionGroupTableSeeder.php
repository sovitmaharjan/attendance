<?php

namespace Database\Seeders;

use App\Models\PermissionGroup;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionGroupTableSeeder extends Seeder
{
    public function run()
    {
        PermissionGroup::create([
            'name' => 'Dashboard'
        ]);
    }
}
