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
       // Schema::table('paginas_secciones_subseccion', function (Blueprint $table) {
            //
       // });
	Schema::table('paginas_secciones_subseccion', function (Blueprint $table) {
    		$table->dropForeign(['seccion_id']);
    		$table->foreign('seccion_id')->references('id')->on('paginas_secciones');
	});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('paginas_secciones_subseccion', function (Blueprint $table) {
            //
        });
    }
};
