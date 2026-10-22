<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Locacao;

class LocacaoSeeder extends Seeder
{
    public function run(): void
    {
        Locacao::create([
            'cliente_id' => 1,
            'equipamento_id' => 2,
            'data_retirada' => now()->subDays(3),
            'data_devolucao_previsa' => now()->addDays(4),
            'valor_total' => 840.00,
            'status' => 'ativo',
        ]);
    }
}
