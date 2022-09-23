<?php

namespace Database\Seeders;

use App\Models\DynamicValue;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DynamicValueTableSeeder extends Seeder
{
    public function run()
    {
        $data['prefix'] = ['Mr.', 'Mrs.', 'Miss', 'Mx.', 'Ms.', 'Dr.', 'Er.'];
        $data['marital_status'] = ['Married', 'Unmarried', 'Divorced', 'Separated'];
        $data['status'] = ['Working', 'Suspended', 'Discharged', 'Dismissed', 'Resigned', 'Inactive'];
        $data['type'] = ['Temporary', 'Permanent', 'Contract', 'Casual', 'Trainee', 'Probation'];

        // foreach($data as $key => $item) {
        //     foreach($item as $item2) {
        //         DynamicValue::create([
                    
        //         ]);
        //     }
        // }
    }
}
