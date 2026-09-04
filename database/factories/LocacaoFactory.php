<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Cliente;
use App\Models\Equipamentos;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Locacaos>
 */
class LocacaoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $dataRetirada = $this->faker->dateTimeBetween('-30 days', 'now');
        $dataDevolucao = $this->faker->dateTimeBetween($dataRetirada, '+15 days');

        return [
            'cliente_id' => Cliente::factory(),
            'equipamento_id' => Equipamentos::factory(),
            'data_retirada' => $dataRetirada,
            'data_devolucao_previsa' => $dataDevolucao,
            'valor_total' => $this->faker->randomFloat(2, 50, 1000),
        ];

    }
}
