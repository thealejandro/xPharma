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
        Schema::create('purchase_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('purchase_id')->constrained('purchases')->onDelete('cascade'); // Foreign key to the purchases table
            $table->foreignId('product_presentation_id')->constrained('product_presentations')->onDelete('cascade'); // Foreign key to the product_presentations table
            $table->integer('quantity'); // Quantity of the product in the purchase
            $table->decimal('unit_cost', 10, 2); // Cost per unit of the product in the purchase
            $table->decimal('profit_margin', 5, 2)->nullable(); // Profit margin of the product in the purchase
            $table->date('expiration_date')->nullable();    // Expiration date of the product
            $table->integer('minimum_stock')->nullable(); // Minimum stock of the product
            $table->timestamps(); // Timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_items');
    }
};
