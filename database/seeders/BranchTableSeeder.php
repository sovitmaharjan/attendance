<?php

namespace Database\Seeders;

use App\Models\Branch;
use App\Models\Company;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BranchTableSeeder extends Seeder
{
    public function run()
    {
        $branch = Branch::create([
            'name' => 'Test Branch',
            'code' => 'TBRA',
            'address' => 'test branch address',
            'email' => 'testbranch@email.com',
            'phone' => '+977-051223454',
            'mobile' => '+977-9876523450',
        ]);
        $branch->status()->updateOrCreate([
            'model_id' => $branch->id,
            'model_type' => get_class($branch)
        ],
        [
            'status_id' => $status_id ?? 1
        ]);
        
        $branch = Branch::create([
            'name' => 'Test Branch 2',
            'code' => 'TBRA2',
            'address' => 'test branch address',
            'email' => 'testbranch@email.com',
            'phone' => '+977-051223454',
            'mobile' => '+977-9876523450',
        ]);
        $branch->status()->updateOrCreate([
            'model_id' => $branch->id,
            'model_type' => get_class($branch)
        ],
        [
            'status_id' => $status_id ?? 1
        ]);

        $branch = Branch::create([
            'name' => 'Test Branch 3',
            'code' => 'TBRA3',
            'address' => 'test branch address',
            'email' => 'testbranch@email.com',
            'phone' => '+977-051223454',
            'mobile' => '+977-9876523450',
        ]);
        $branch->status()->updateOrCreate([
            'model_id' => $branch->id,
            'model_type' => get_class($branch)
        ],
        [
            'status_id' => $status_id ?? 1
        ]);


        $branch = Branch::create([
            'name' => 'Test Branch 4',
            'code' => 'TBRA4',
            'address' => 'test branch address',
            'email' => 'testbranch@email.com',
            'phone' => '+977-051223454',
            'mobile' => '+977-9876523450',
        ]);
        $branch->status()->updateOrCreate([
            'model_id' => $branch->id,
            'model_type' => get_class($branch)
        ],
        [
            'status_id' => $status_id ?? 1
        ]);
    }
}
