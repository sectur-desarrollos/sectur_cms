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
       // Schema::table('paginas_secciones_subseccion_archivos', function (Blueprint $table) {
            //
       // });
	Schema::table('paginas_secciones_subseccion_archivos', function (Blueprint $table) {
   		 $table->dropForeign(['subseccion_id']);
   		 $table->foreign('subseccion_id')->references('id')->on('paginas_secciones_subseccion');
	});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('paginas_secciones_subseccion_archivos', function (Blueprint $table) {
            //
        });
    }
};
