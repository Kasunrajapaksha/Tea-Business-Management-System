<?php

namespace Database\Factories;

use App\Models\Department;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Role>
 */
class RoleFactory extends Factory
{
    public function definition(): array
    {
        return [
            'role_name' => fake()->jobTitle(),
            'department_id' => Department::factory(),
            'status' => 0,
        ];
    }
}
