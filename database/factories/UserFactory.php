<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\Designation;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $company = rand(1, 2);
        if ($company == 1) {
            $branch = rand(1, 2);
            if ($branch == 1) {
                $department = rand(1, 2);
            } 
            if ($branch == 2) {
                $department = rand(2, 4);
            }
        } else {
            $branch = rand(3, 4);
            if ($branch == 3) {
                $department = rand(1, 2);
            } 
            if ($branch == 4) {
                $department = rand(2, 4);
            }
        }
        $gender = ['Male', 'Female'];
        return [
            'prefix' => 'Mr.',
            'firstname' => fake()->firstName(),
            'middlename' => fake()->lastName(),
            'lastname' => fake()->lastName(),
            'email' => fake()->email(),
            'phone' => fake()->phoneNumber(),
            'address' => fake()->address(),
            'gender' => $gender[rand(0, 1)],
            'marital_status' => 'Unmarried',
            'dob' => fake()->date('Y-m-d'),
            'join_date' => now(),
            'branch_id' => $branch,
            'department_id' => $department,
            'designation_id' => Designation::find(1)->id,
            'login_id' => Company::find($company)->code . '-' . rand(0, 99) . rand(0, 99),
            'supervisor_id' => null,
            'password' => bcrypt('123'),
            'login_count' => 0,
            'status' => 'Working',
            'type' => 'Permanent',
            'role_id' => 1,
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
