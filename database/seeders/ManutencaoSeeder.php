<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Manutencao;

class ManutencaoSeeder extends Seeder
{
    public function run(): void
    {
        Manutencao::create([
            'equipamento_id' => 1,
            'descricao' => 'Calibração periódica e troca de ponteiras',
            'data' => now()->subDays(10),
            'custo' => 150.00,
        ]);
    }
}
