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
        Schema::table('stocks', function (Blueprint $table) {
            $table->dropColumn('unidad_medida'); // Eliminar la columna 'unidad_medida'
        });
    }

    public function down()
    {
        Schema::table('stocks', function (Blueprint $table) {
            $table->string('unidad_medida')->after('nombre'); // Volver a agregar la columna 'unidad_medida' si es necesario
        });
    }

};
