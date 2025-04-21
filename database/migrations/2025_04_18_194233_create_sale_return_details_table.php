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
        Schema::create('sale_return_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sale_return_id')->constrained('sale_returns')->onDelete('cascade'); // si es null, se asume que el cliente es el usuario
            $table->foreignId('sale_detail_id')->constrained('sale_details')->onDelete('cascade'); // si es null, se asume que el cliente es el usuario
            $table->integer('quantity'); // cantidad de producto devuelto
            // $table->decimal('unit_price', 10, 2); // precio unitario del producto
            // $table->integer('contable_quantity')->default(0); // cantidad contable del producto
            // $table->integer('non_contable_quantity')->default(0); // cantidad no contable del producto
            $table->text('observations')->nullable(); // observaciones
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sale_return_details');
    }
};
