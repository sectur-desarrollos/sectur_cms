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
       // Schema::table('paginas_secciones', function (Blueprint $table) {
            //
       // });
	Schema::table('paginas_secciones', function (Blueprint $table) {
   		 $table->dropForeign(['pagina_id']);
   		 $table->foreign('pagina_id')->references('id')->on('paginas');
	});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('paginas_secciones', function (Blueprint $table) {
            //
        });
    }
};
