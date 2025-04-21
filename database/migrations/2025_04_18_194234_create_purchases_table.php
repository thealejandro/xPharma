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
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->foreignId('supplier_id')->constrained()->onDelete('cascade'); // Relación con la tabla suppliers (suplidor)
            $table->string('invoice_number')->nullable(); // número real o interno
            $table->boolean('has_invoice')->default(true); // indica si tiene factura
            $table->date('invoice_date');   // fecha de la factura
            $table->decimal('total', 10, 2)->default(0); // total de la compra
            $table->boolean('verified')->default(false); // indica si la compra ha sido verificada
            $table->timestamps(); // fecha de creación y actualización
            $table->softDeletes(); // fecha de eliminación lógica
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade'); // usuario que crea la compra
            // $table->foreignId('updated_by')->constrained('users')->onDelete('cascade'); // usuario que actualiza la compra
            // $table->foreignId('deleted_by')->nullable()->constrained('users')->onDelete('cascade'); // usuario que elimina la compra
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchases');
    }
};
