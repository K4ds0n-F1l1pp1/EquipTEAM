<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pagamento;

class PagamentoSeeder extends Seeder
{
    public function run(): void
    {
        Pagamento::create([
            'locacao_id' => 1,
            'valor' => 840.00,
            'forma_pagamento' => 'Pix',
        ]);
    }
}