<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Provider\pt_BR\Person;

class ClientFactory extends Factory
{
    public function withFaker()
    {
        return \Faker\Factory::create('pt_BR');
    }
    
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'date_of_birth' => $this->faker->dateTimeThisCentury->format('Y-m-d'),
            'email' => $this->faker->unique()->safeEmail(),
            'cell' => $this->faker->phoneNumber(),
            'telephone' => $this->faker->phoneNumber(),
            'document' => $this->faker->cpf(false),
            'document_secondary' => $this->faker->rg(false),
            'genre' => $this->faker->randomElement(['M', 'F']),
            'created_at' => now(),
            'updated_at' => now()
        ];
    }
}
