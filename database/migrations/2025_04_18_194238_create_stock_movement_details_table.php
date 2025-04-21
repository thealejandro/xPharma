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
        Schema::create('stock_movement_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('stock_movement_id')->constrained('stock_movements')->onDelete('cascade'); // Assuming stock_movements table exists and is a foreign key to this table
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade'); // Assuming products table exists and is a foreign key to this table
            $table->integer('quantity'); // Quantity of the product in the stock movement
            $table->date('expiration_date')->nullable(); // Expiration date of the product
            $table->string('batch_code', 50)->nullable(); // Batch code of the product
            $table->foreignId('presentation_id')->nullable()->constrained('presentations')->nullOnDelete(); // Assuming presentations table exists
            $table->timestamps(); // Timestamps for created_at and updated_at
            $table->softDeletes(); // Soft delete column
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_movement_details');
    }
};
