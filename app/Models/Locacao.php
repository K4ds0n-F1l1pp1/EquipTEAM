<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Locacao extends Model
{
    use HasFactory;
    protected $fillable = ['cliente_id', 'equipamento_id', 'data_retirada', 'data_devolucao_previsa', 'valor_total', 'status'];
}
