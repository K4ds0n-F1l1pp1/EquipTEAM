<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Equipamentos>
 */
class EquipamentosFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nome' => $this->faker->randomElement([
                'Furadeira', 'Serra Elétrica', 'Betoneira', 'Andaime',
                'Compressor de Ar', 'Lixadeira', 'Martelete', 'Gerador'
            ]) . ' ' . $this->faker->word(),
            'numero_serie' => $this->faker->unique()->numerify('SN-#####'),
            'valor_diaria' => $this->faker->randomFloat(2, 30, 300),
            'status' => 'disponivel',
        ];
    }
}
