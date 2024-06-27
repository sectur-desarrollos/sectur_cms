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
        Schema::create('historial_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('usuario_id'); // Solo almacenará el número de usuario
            $table->string('usuario_nombre');
            $table->string('accion');
            $table->string('lugar');
            $table->string('informacion');
            $table->timestamp('fecha_accion')->useCurrent();
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
        Schema::dropIfExists('historial_logs');
    }
};
