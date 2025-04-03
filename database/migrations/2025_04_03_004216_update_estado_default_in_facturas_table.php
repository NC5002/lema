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
        Schema::table('facturas', function (Blueprint $table) {
            $table->enum('estado', ['Pendiente', 'Pagado', 'Anulado'])->default('Pendiente')->change();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('facturas', function (Blueprint $table) {
            $table->enum('estado', ['Pagado', 'Anulado'])->default('Pagado')->change(); // o el anterior que tenías
        });
    }

};
