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
        Schema::create('compras', function (Blueprint $table) {
            $table->id();
            $table->foreignId('usuario_id')->constrained('users'); 
            $table->foreignId('proveedor_id')->constrained('proveedores'); 
            $table->enum('estado', ['Pendiente', 'Pagado']);
            $table->decimal('subtotal', 10, 2);
            $table->decimal('iva', 10, 2);
            $table->enum('tipo_compra', ['Factura', 'Nota de compra']);
            $table->dateTime('fecha_compra');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('compras');
    }
};
