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
        Schema::create('locacaos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cliente_id')->constrained('clientes')->onDelete('cascade');
            $table->foreignId('equipamento_id')->constrained('equipamentos')->onDelete('cascade'); // Sempre que deletado os seus outros dados anexados serão excuídos jutnos.
            $table->date('data_retirada');
            $table->date('data_devolucao_previsa');
            $table->decimal('valor_total', 10, 2)->nullable();
            $table->string('status')->default('Ativa'); // Ativa ou Finalizada.
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('locacaos');
    }
};
