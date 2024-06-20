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
        Schema::create('secciones_v2', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pagina_id')->constrained('paginas_v2');
            $table->string('titulo');
            $table->string('slug');
            $table->integer('ordenamiento');
            $table->boolean('activo');
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
        Schema::dropIfExists('secciones_v2');
    }
};
