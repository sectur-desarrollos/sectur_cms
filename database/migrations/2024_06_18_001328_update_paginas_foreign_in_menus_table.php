<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('menus', function (Blueprint $table) {
            // Agregar la nueva clave foránea referenciando a paginas_v2
            $table->foreign('pagina_id')->references('id')->on('paginas_v2');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('menus', function (Blueprint $table) {
            // Revertir la clave foránea a paginas
            $table->dropForeign(['pagina_id']);
            $table->foreign('pagina_id')->references('id')->on('paginas');
        });
    }
};
