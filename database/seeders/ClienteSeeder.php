<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cliente;

class ClienteSeeder extends Seeder
{
    public function run(): void
    {
        Cliente::create([
            'nome' => 'João da Silva',
            'email' => 'joao@email.com',
            'telefone' => '(49) 99999-9999',
            'cpf' => '123.456.789-00',
        ]);

        Cliente::create([
            'nome' => 'Maria Oliveira',
            'email' => 'maria@email.com',
            'telefone' => '(49) 98888-8888',
            'cpf' => '987.654.321-11',
        ]);
    }
}
