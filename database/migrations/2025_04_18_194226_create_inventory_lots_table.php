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
        Schema::create('inventory_lots', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade'); // Assuming you have a products table
            $table->foreignId('branch_id')->constrained()->onDelete('cascade'); // Assuming you have a branches table
            $table->date('expiration_date'); // Date when the lot expires
            $table->integer('quantity'); // quantity of the lot
            $table->string('batch_code', 50)->nullable(); // batch code of the lot (if any)
            $table->json('location')->nullable(); // {"estante":"A1","caja":"3","nivel":"2"}
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory_lots');
    }
};
