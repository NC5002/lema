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
        Schema::table('productos', function (Blueprint $table) {
            $table->dropColumn('stock');
        });
    }

    public function down()
    {
        Schema::table('productos', function (Blueprint $table) {
            $table->integer('stock')->default(0); // Revertir el cambio, si es necesario
        });
    }

};
