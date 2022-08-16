<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'cod_employee' => 'COD'.$this->faker->numberBetween(1,999),
            'name_employee' => $this->faker->name,
            'department_employee' => $this->faker->jobTitle,
            'days_free_employee' => $this->faker->numberBetween(1,30),
        ];
    }
}
