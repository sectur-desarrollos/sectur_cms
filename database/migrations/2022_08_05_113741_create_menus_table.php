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
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->string('name', 150);
            $table->string('slug', 150)->unique();
            $table->unsignedInteger('parent')->default(0);
            $table->smallInteger('order')->default(0);
            $table->boolean('enabled')->default(1);
            $table->longText('enlace')->nullable();
            $table->enum('target',['_blank','_self','_parent','_top'])->default('_blank')->nullable();
            $table->unsignedBigInteger('pagina_id')->nullable();
            $table->foreign('pagina_id')->references('id')->on('paginas');
            $table->unsignedInteger('menu_id')->nullable();
            $table->string('nombre_pagina')->nullable();
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
        Schema::dropIfExists('menus');
    }
};
