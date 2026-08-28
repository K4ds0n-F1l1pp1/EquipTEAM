<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('equipamentos', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('numero_serie')->unique();
            $table->decimal('valor_diaria', 8, 2); // Até 8 casa + duas após a vírgula.
            $table->string('status')->default('Disponível'); // São os valores: Disponível, Alocado, Manutenção -> por padrão vem disponível.
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipamentos');
    }
};
