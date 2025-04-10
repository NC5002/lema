<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('unidades', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->unique(); // Nombre de la unidad de medida
            $table->timestamps();
        });

        // Añadir la columna de unidad_id en la tabla 'stocks'
        Schema::table('stocks', function (Blueprint $table) {
            $table->unsignedBigInteger('unidad_id')->nullable(); // Relación con la tabla unidades
            $table->foreign('unidad_id')->references('id')->on('unidades')->onDelete('set null');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down()
    {
        // Eliminar la relación y columna de 'unidad_id' en 'stocks'
        Schema::table('stocks', function (Blueprint $table) {
            $table->dropForeign(['unidad_id']);
            $table->dropColumn('unidad_id');
        });

        // Eliminar la tabla 'unidades'
        Schema::dropIfExists('unidades');
    }

};
