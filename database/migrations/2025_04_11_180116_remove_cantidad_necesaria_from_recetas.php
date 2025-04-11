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
            $table->dropColumn('cantidad_necesaria');
        });
    }

    public function down()
    {
        Schema::table('recetas', function (Blueprint $table) {
            $table->decimal('cantidad_necesaria', 8, 2)->nullable(); // Restaurar la columna si es necesario
        });
    }

};
