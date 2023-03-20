<?php

namespace Database\Seeders;

use App\Models\Branch;
use Illuminate\Database\Seeder;

class BranchTableSeeder extends Seeder
{
    public function run()
    {
        Branch::create([
            'name' => 'Test Branch 1',
            'code' => 'TBRA1',
            'address' => 'test branch address',
            'email' => 'testbranch1@email.com',
            'phone' => '+977-051223454',
            'mobile' => '+977-9876523450',
            'status' => 1,
        ]);
        Branch::create([
            'name' => 'Test Branch 2',
            'code' => 'TBRA2',
            'address' => 'test branch address',
            'email' => 'testbranch2@email.com',
            'phone' => '+977-051223454',
            'mobile' => '+977-9876523450',
            'status' => 1,
        ]);
        Branch::create([
            'name' => 'Test Branch 3',
            'code' => 'TBRA3',
            'address' => 'test branch address',
            'email' => 'testbranch3@email.com',
            'phone' => '+977-051223454',
            'mobile' => '+977-9876523450',
            'status' => 1,
        ]);
        Branch::create([
            'name' => 'Test Branch 4',
            'code' => 'TBRA4',
            'address' => 'test branch address',
            'email' => 'testbranch4@email.com',
            'phone' => '+977-051223454',
            'mobile' => '+977-9876523450',
            'status' => 1,
        ]);
    }
}
