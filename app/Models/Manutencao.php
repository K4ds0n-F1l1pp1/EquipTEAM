<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Equipamentos;

class Manutencao extends Model
{
    use HasFactory;

    protected $fillable = ['equipamento_id', 'descricao', 'data_manutencao', 'custo', 'foto_manutencao'];

    public function equipamentos()
    {
        return $this->belongsTo(Equipamentos::class, 'equipamento_id');
    }
}
