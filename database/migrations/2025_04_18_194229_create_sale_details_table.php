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
        Schema::create('sale_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sale_id')->constrained('sales')->onDelete('cascade');  // si es null, se asume que el cliente es el usuario
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');  // si es null, se asume que el cliente es el usuario
            $table->foreignId('lot_id')->constrained('inventory_lots')->onDelete('cascade');  // si es null, se asume que el cliente es el usuario
            $table->foreignId('presentation_id')->constrained('presentations')->onDelete('cascade');  // si es null, se asume que el cliente es el usuario
            $table->integer('quantity'); // cantidad de producto vendido
            $table->decimal('unit_price', 10, 2); // precio unitario del producto
            $table->integer('contable_quantity')->default(0); // cantidad contable del producto
            $table->integer('non_contable_quantity')->default(0); // cantidad no contable del producto
            $table->timestamps(); // fecha de venta
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sale_details');
    }
};
