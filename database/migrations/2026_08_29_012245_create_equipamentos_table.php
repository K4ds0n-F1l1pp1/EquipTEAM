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
            $table->string('numero_serie')->unique(); // É um dado que somente pode haver um.
            $table->decimal('valor_diaria', 8, 2);
            $table->string('status')->default('Disponível'); // Pode ser: Disponível, Alocado, Manutenção - mas por padrão é "Disponível".
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
