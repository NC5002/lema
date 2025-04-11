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
        Schema::table('receta_stock', function (Blueprint $table) {
            $table->decimal('cantidad_necesaria', 8, 2)->nullable(false)->change();
        });
    }

    public function down()
    {
        Schema::table('receta_stock', function (Blueprint $table) {
            $table->decimal('cantidad_necesaria', 8, 2)->nullable()->change();
        });
    }
};
