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
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nombre del proveedor (nombre de la empresa)
            $table->string('nit')->nullable()->unique(); // NIT (Número de Identificación Tributaria)
            $table->string('phone')->nullable(); // Phone number
            $table->string('address')->nullable(); // Address
            $table->string('email')->nullable(); // Email
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suppliers');
    }
};
