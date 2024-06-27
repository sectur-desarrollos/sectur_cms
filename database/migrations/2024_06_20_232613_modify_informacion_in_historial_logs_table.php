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
        Schema::table('historial_logs', function (Blueprint $table) {
            $table->dropColumn(['informacion']);
        });

        Schema::table('historial_logs', function (Blueprint $table) {
            $table->longText('informacion')->after('lugar');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('historial_logs', function (Blueprint $table) {
            $table->dropColumn(['informacion']);
        });
        
        Schema::table('historial_logs', function (Blueprint $table) {
            $table->string('informacion');
        });
    }
};
