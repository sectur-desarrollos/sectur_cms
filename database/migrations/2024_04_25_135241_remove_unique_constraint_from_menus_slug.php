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
        Schema::table('menus_slug', function (Blueprint $table) {
            Schema::table('menus', function (Blueprint $table) {
            $table->dropUnique(['slug']); // Eliminar la restricción única
        });
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('menus_slug', function (Blueprint $table) {
            Schema::table('menus', function (Blueprint $table) {
            $table->unique('slug'); // Volver a agregar la restricción única en caso de reversión
        });
        });
    }
};
