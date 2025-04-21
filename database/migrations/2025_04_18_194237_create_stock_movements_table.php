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
        Schema::create('stock_movements', function (Blueprint $table) {
            $table->id();
            $table->string('movement_type', 50); // compra, envio, devolucion_envio, ajuste
            // $table->foreignId('origin_id')->nullable(); // puede ser null si es compra directa o envio
            $table->foreign('origin_id')->references('id')->on('stock_movements')->onDelete('cascade'); // referencia a la tabla stock_movements
            $table->foreignId('destination_id')->nullable(); // puede ser null si es compra directa o devolucion_envio
            $table->decimal('quantity', 10, 2); // cantidad de producto
            $table->foreignId('purchase_id')->nullable()->constrained('purchases')->nullOnDelete(); // id de la compra asociada
            $table->foreignId('authorized_by')->nullable()->constrained('users')->nullOnDelete(); // id del usuario que autoriza el movimiento
            $table->foreignId('received_by')->nullable()->constrained('users')->nullOnDelete(); // id del usuario que recibe el movimiento
            $table->foreignId('requested_by')->nullable()->constrained('users')->nullOnDelete(); // id del usuario que solicita el movimiento
            $table->foreignId('rejected_by')->nullable()->constrained('users')->nullOnDelete(); // id del usuario que rechaza el movimiento
            $table->date('requested_date')->nullable(); // fecha de solicitud del movimiento
            $table->date('received_date')->nullable(); // fecha de recepción del movimiento
            $table->date('rejected_date')->nullable(); // fecha de rechazo del movimiento
            $table->text('comments')->nullable(); // comentarios del movimiento
            $table->string('status', 20)->nullable(); // pendiente, recibido, rechazado
            $table->timestamps(); // fecha de creación y actualización
            $table->softDeletes(); // fecha de eliminación lógica
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_movements');
    }
};
