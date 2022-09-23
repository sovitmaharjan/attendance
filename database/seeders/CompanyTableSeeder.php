<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanyTableSeeder extends Seeder
{
    public function run()
    {
        $company = Company::create([
            'name' => 'Test Company',
            'code' => 'TCOM',
            'address' => 'test address',
            'email' => 'testcompany@email.com',
            'phone' => '+977-051220194',
            'mobile' => '+977-9876543210',
            'website' => 'testcompany.com',
        ]);
        // dd($company);
        $company->status()->updateOrCreate([
            'model_id' => $company->id,
            'model_type' => get_class($company)
        ],
        [
            'status_id' => $status_id ?? 1
        ]);
    }
}
