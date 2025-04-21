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
        Schema::create('canceled_invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('invoice_id')->constrained('invoices')->onDelete('cascade'); // si es null, se asume que el cliente es el usuario
            $table->text('reason')->nullable(); // razón de cancelación
            $table->date('canceled_at'); // fecha de cancelación
            $table->foreignId('canceled_by')->constrained('users'); // usuario que cancela la factura
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('canceled_invoices');
    }
};
