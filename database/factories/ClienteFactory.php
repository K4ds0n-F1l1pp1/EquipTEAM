<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ClienteFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nome' => $this->faker->name(),
            'cpf_cnpj' => $this->faker->numerify('###########'),
            'telefone' => $this->faker->numerify('(##) #####-####'),
            'endereco' => $this->faker->address(),
            'email' => $this->faker->unique()->safeEmail(),
        ];
    }
}
