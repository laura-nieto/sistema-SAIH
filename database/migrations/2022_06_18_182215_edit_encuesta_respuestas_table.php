<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EditEncuestaRespuestasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('encuesta_respuestas',function(Blueprint $table){
            $table->foreignId('colaborador_id')->nullable()->constrained('colaboradores')->onDelete('cascade');
            $table->foreignId('cuestionario_id')->nullable()->constrained('cuestionario')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
