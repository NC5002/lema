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
        Schema::table('recetas', function (Blueprint $table) {
            // Eliminar la clave foránea antes de eliminar la columna
            $table->dropForeign(['ingrediente_id']);  // Eliminar la clave foránea
            $table->dropColumn('ingrediente_id');  // Ahora podemos eliminar la columna
        });
    }

    public function down()
    {
        Schema::table('recetas', function (Blueprint $table) {
            // Revertir la eliminación de la columna
            $table->unsignedBigInteger('ingrediente_id')->nullable();
            // Si quieres restaurar la clave foránea, puedes hacerlo de esta manera:
            // $table->foreign('ingrediente_id')->references('id')->on('ingredientes');
        });
    }

};
