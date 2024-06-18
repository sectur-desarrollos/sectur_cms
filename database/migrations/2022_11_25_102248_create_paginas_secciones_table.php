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
        Schema::create('paginas_secciones', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->string('slug');
            $table->enum('estado', ['Si','No'])->default('Si');
            $table->unsignedBigInteger('pagina_id')->nullable();
            $table->foreign('pagina_id')->references('id')->on('paginas')->onDelete('cascade');
            $table->string('pagina_slug');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('paginas_secciones');
    }
};
