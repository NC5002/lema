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
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre'); 
            $table->text('descripcion')->nullable(); 
            $table->foreignId('categoria_id')->constrained('categorias'); 
            $table->decimal('precio_venta', 10, 2); 
            $table->string('imagen')->nullable(); 
            $table->enum('estatus', ['Activo', 'Inactivo']); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
