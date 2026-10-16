<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pagamento extends Model
{
    use HasFactory;

    protected $fillable = ['locacao_id', 'valor', 'forma_pagamento', 'status'];

    public function locacao()
    {
        return $this->belongTo(Locacao::class);
    }
}
