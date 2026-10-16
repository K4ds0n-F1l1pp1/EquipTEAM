<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Equipamentos;

class Manutencao extends Model
{
    use HasFactory;

    protected $fillable = ['descricao', 'data_manutancao', 'custo'];

    public function equipamentos()
    {
        return $this->belongsTo(Equipamentos::class);
    }
}
