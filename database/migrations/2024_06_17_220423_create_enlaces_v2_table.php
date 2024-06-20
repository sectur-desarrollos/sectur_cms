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
        Schema::create('enlaces_v2', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pagina_id')->nullable();
            $table->unsignedBigInteger('seccion_id')->nullable();
            $table->unsignedBigInteger('subseccion_id')->nullable();
            $table->string('nombre');
            $table->string('url');
            $table->integer('ordenamiento');
            $table->boolean('activo')->default(true);
            $table->timestamps();

            // Foreign keys
            $table->foreign('pagina_id')->references('id')->on('paginas_v2');
            $table->foreign('seccion_id')->references('id')->on('secciones_v2');
            $table->foreign('subseccion_id')->references('id')->on('subsecciones_v2');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('enlaces_v2');
    }
};
