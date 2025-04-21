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
        Schema::create('shipment_returns', function (Blueprint $table) {
            $table->id();
            $table->foreignId('original_movement_id')->constrained('stock_movements')->onDelete('cascade'); // Foreign key to the original stock movement
            $table->foreignId('return_movement_id')->constrained('stock_movements')->onDelete('cascade'); // Foreign key to the return stock movement
            $table->text('reason')->nullable(); // Reason for the return
            $table->foreignId('authorized_by')->nullable()->constrained('users')->nullOnDelete(); // User who authorized the return
            $table->date('date'); // Date of the return
            $table->timestamps(); // Timestamps
            $table->softDeletes(); // Soft delete column
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipment_returns');
    }
};
