<?php

namespace Database\Seeders;

use App\Models\DynamicValue;
use Illuminate\Database\Seeder;

class DynamicValueTableSeeder extends Seeder
{
    public function run()
    {
        $data['prefix'] = ['Mr.', 'Mrs.', 'Ms.'];
        $data['marital_status'] = ['Married', 'Unmarried', 'Divorced'];
        $data['employee_status'] = ['Working', 'Suspended', 'Dismissed', 'Resigned', 'Inactive'];
        $data['employee_type'] = ['Temporary', 'Permanent', 'Contract', 'Trainee', 'Probation'];

        foreach($data as $key => $item) {
            $key = $key;
            foreach($item as $item2) {
                DynamicValue::create([
                    'key' => $key,
                    'value' => json_encode([
                        'name' => $item2,
                        'value' => 1
                    ]),
                    'name' => $item2,
                    'status' => 1
                ]);
            }
        }
    }
}
