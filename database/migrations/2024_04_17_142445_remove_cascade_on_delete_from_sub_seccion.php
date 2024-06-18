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
       // Schema::table('sub_seccion', function (Blueprint $table) {
            //
       // });

	Schema::table('sub_seccion', function (Blueprint $table) {
       	  $table->dropForeign(['seccion_id']);
   	  $table->foreign('seccion_id')->references('id')->on('seccion');
	});

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sub_seccion', function (Blueprint $table) {
            //
        });
    }
};
