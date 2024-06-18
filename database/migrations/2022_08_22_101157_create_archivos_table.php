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
        Schema::create('archivos', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->string('imagen')->nullable();
            $table->string('documento')->nullable();
            $table->string('descripcion')->nullable();
            $table->string('size_documento')->nullable();
            $table->string('type_documento')->nullable();
            $table->string('size_imagen')->nullable();
            $table->string('type_imagen')->nullable();
            $table->string('enlace')->nullable();
            $table->enum('estado', ['Si','No'])->default('Si');
            $table->unsignedBigInteger('pagina_id')->nullable();
            $table->foreign('pagina_id')->references('id')->on('paginas');
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
        Schema::dropIfExists('archivos');
    }
};
