<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Manutencao;

class Equipamentos extends Model
{
    use HasFactory;
    protected $fillable = ['nome', 'numero_serie', 'valor_diaria', 'status', 'foto'];

    public function manutencoes()
    {
        return $this->hasMany(Manutencao::class);
    }
}
