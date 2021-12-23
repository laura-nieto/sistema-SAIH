<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEncuestaPreguntasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('encuesta_preguntas', function (Blueprint $table) {
            $table->id();
            $table->string('pregunta');
            $table->softDeletes('deleted_at');
            $table->timestamps();
        });
        Schema::create('encuesta_respuestas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pregunta_id')->constrained('encuesta_preguntas')->onDelete('cascade');
            $table->string('respuesta');
            $table->softDeletes('deleted_at');
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
        Schema::dropIfExists('encuesta_preguntas');
    }
}
