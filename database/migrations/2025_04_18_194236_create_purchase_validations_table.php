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
        Schema::create('purchase_validations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('purchase_item_id')->constrained('purchase_items')->onDelete('cascade'); // Llvea a la tabla purchase_items para que se puedan ver las compras realizadas
            $table->integer('verified_quantity'); // Cantidad verificada
            $table->foreignId('verified_by')->nullable()->constrained('users')->nullOnDelete(); // Usuario que verifica la compra
            $table->text('notes')->nullable(); // Notas de la compra verificada por el usuario
            $table->timestamps(); // Fecha de creación y actualización
            $table->softDeletes(); // Fecha de eliminación lógica
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_validations');
    }
};
