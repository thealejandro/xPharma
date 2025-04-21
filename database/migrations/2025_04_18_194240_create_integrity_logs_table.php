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
        Schema::create('integrity_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade'); // Assuming you have a products table
            $table->foreignId('branch_id')->constrained('branches')->onDelete('cascade'); // Assuming you have a branches table
            $table->date('revision_date'); // Date of the inventory revision
            $table->integer('expected_quantity'); // Expected quantity from the inventory revision
            $table->integer('actual_quantity'); // Actual quantity from the inventory revision
            $table->integer('difference')->nullable(); // Difference between expected and actual quantities
            $table->boolean('justified')->default(false); // Whether the difference is justified
            $table->text('reason')->nullable(); // Reason for the difference if justified is false
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete(); // Assuming you have a users table
            $table->timestamps(); // Timestamps for created_at and updated_at
            $table->softDeletes(); // Soft delete column
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('integrity_logs');
    }
};
