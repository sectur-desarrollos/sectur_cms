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
        Schema::create('sub_seccion', function (Blueprint $table) {
            $table->id();
            $table->string('titulo')->nullable();
            $table->string('imagen')->nullable();
            $table->string('imagen_telefono')->nullable(); //Se agregó esta columna para imagenes version telefono
            $table->string('descripcion')->nullable();
            $table->string('enlace')->nullable();
            $table->enum('estado', ['Si','No'])->default('Si');
            $table->unsignedBigInteger('seccion_id');
            $table->foreign('seccion_id')->references('id')->on('seccion')->onDelete('cascade');
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
        Schema::dropIfExists('sub_seccion');
    }
};
