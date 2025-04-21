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
        Schema::create('sale_returns', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sale_id')->constrained('sales')->onDelete('cascade'); // si es null, se asume que el cliente es el usuario
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // si es null, se asume que el cliente es el usuario
            $table->date('date'); // fecha de retorno
            $table->text('reason')->nullable(); // razón del retorno
            $table->string('status')->default('approved'); // estado del retorno (approved, rejected, pending)
            $table->timestamps(); // fecha de retorno
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sale_returns');
    }
};
