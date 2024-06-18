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
        Schema::create('seccion', function (Blueprint $table) {
            $table->id();
            $table->string('titulo')->nullable();
            $table->string('descripcion')->nullable();
            $table->string('identificador')->nullable();
            $table->string('imagen')->nullable();
            $table->string('imagen_telefono')->nullable();
            $table->string('tipo');
            // $table->string('orden');
            $table->integer('orden');
            $table->enum('estado', ['Si','No'])->default('Si');
            // $table->string('color');
            $table->string('enlace')->nullable();
            $table->longText('mapa')->nullable();
            $table->string('banner_principal')->default('No');
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
        Schema::dropIfExists('seccion');
    }
};
