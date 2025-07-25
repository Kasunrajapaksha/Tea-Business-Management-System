<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $countryIds = \App\Models\Country::pluck('id')->toArray();
        $userIds = \App\Models\User::pluck('id')->toArray();

        foreach (range(1, 10) as $i) {
            Customer::create([
                'customer_no' => 'CUS' . str_pad($i, 8, '0', STR_PAD_LEFT),
                'first_name' => fake()->firstName,
                'last_name' => fake()->lastName,
                'email' => fake()->unique()->safeEmail,
                'number' => fake()->numerify('07########'),
                'address' => fake()->address,
                'status' => 'active',
                'country_id' => $countryIds ? fake()->randomElement($countryIds) : null,
                'user_id' => $userIds ? fake()->randomElement($userIds) : null,
            ]);
        }
    }
}
