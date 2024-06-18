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
        Schema::create('paginas', function (Blueprint $table) {
            $table->id();
            $table->string('titulo'); 
            $table->string('slug');
            $table->string('imagen_destacada')->nullable();
            $table->longText('contenido')->nullable();
            $table->enum('tipo_pagina', ['pagina','blog','galeria'])->default('pagina');
            $table->enum('estado', ['Si','No'])->default('Si');
            $table->enum('imagen_principal_estado', ['Si','No'])->default('Si');
            $table->string('fuente')->nullable();
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
        Schema::dropIfExists('paginas');
    }
};
