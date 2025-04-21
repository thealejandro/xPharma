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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name', 150);  // nombre del producto
            $table->string('code', 50)->unique(); // código del producto
            $table->decimal('base_price', 10, 2);   // precio base del producto
            $table->boolean('active')->default(true);   // si es false, se considera que el producto está inactivo
            $table->boolean('billable')->default(true); // si es false, se considera que el producto no se factura
            $table->boolean('exempt_iva')->default(false);  // si es true, se considera que el producto no paga IVA
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
