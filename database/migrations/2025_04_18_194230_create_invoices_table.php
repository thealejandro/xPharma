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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sale_id')->constrained('sales')->onDelete('cascade');  // si es null, se asume que el cliente es el usuario
            $table->date('issue_date'); // fecha de emisión de la factura
            $table->string('status', 20)->default('issued'); // estado de la factura (issued, paid, canceled)
            $table->unsignedBigInteger('certifier_id')->nullable(); // usuario que certifica la factura
            $table->timestamps(); // fecha de factura
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
