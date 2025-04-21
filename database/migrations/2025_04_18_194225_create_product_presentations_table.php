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
        Schema::create('product_presentations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade'); // Assuming you have a products table
            $table->foreignId('presentation_id')->constrained()->onDelete('cascade'); // Assuming you have a presentations table
            $table->integer('unit_quantity'); // factor
            $table->decimal('sale_price', 10, 2)->nullable(); // se puede autocalcular // precio venta de la compra
            $table->boolean('active')->default(true); // estado de la presentación
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_presentations');
    }
};
