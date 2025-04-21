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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->nullable()->constrained('clients')->nullOnDelete(); // si es null, se asume que el cliente es el usuario
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // si es null, se asume que el cliente es el usuario
            $table->foreignId('branch_id')->constrained('branches')->onDelete('cascade'); // si es null, se asume que el cliente es el usuario
            $table->decimal('total', 10, 2); // total de la venta
            $table->date('date'); // fecha de la venta
            // $table->string('payment_method'); // metodo de pago
            // $table->string('status')->default('completed'); // estado de la venta (completed, pending, cancelled)
            // $table->string('reference')->nullable(); // referencia de la venta (por ejemplo, un número de factura)
            // $table->string('note')->nullable(); // nota de la venta
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
