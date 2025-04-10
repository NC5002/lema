<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameIngredientesToStocks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Renombrar la tabla 'ingredientes' a 'stocks'
        Schema::rename('ingredientes', 'stocks');

        // Cambiar la estructura de la tabla: agregar el campo 'tipo' y cualquier otro ajuste necesario
        Schema::table('stocks', function (Blueprint $table) {
            // Cambiar el tipo de datos si es necesario, por ejemplo:
            $table->string('tipo')->after('estado');  // 'Producto' o 'Ingrediente'

            // Si 'cantidad_stock' ya existe, asegúrate de que sea compatible
            $table->decimal('cantidad_stock', 8, 2)->change(); // Asegúrate de que sea compatible con la nueva lógica

            // Si agregas nuevas columnas, como 'created_by' y 'updated_by':
            $table->unsignedBigInteger('created_by')->nullable()->after('estado');
            $table->unsignedBigInteger('updated_by')->nullable()->after('created_by');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Deshacer el renombrado de la tabla y los cambios
        Schema::table('stocks', function (Blueprint $table) {
            // Eliminar las nuevas columnas
            $table->dropColumn('tipo');
            $table->dropColumn('created_by');
            $table->dropColumn('updated_by');
        });

        Schema::rename('stocks', 'ingredientes');
    }
}
