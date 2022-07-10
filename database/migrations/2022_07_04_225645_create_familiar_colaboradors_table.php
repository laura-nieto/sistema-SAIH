<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFamiliarColaboradorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users',function(Blueprint $table){
            $table->dropIndex('users_empresa_id_foreign');
            $table->dropColumn('empresa_id');
            //ALTER TABLE users DROP FOREIGN KEY users_empresa_id_foreign;
            $table->after('id', function ($table) {
                $table->foreignId('cliente_id')->nullable()->constrained('clientes')->onDelete('cascade');
            });
        });
        Schema::create('familiar_colaborador', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('paciente_id')->unsigned()->nullable();
            $table->foreignId('cliente_id')->nullable()->constrained('clientes')->onDelete('cascade');
            $table->string('folio_tarjeta',30)->nullable();
            $table->string('apellido_paterno',30)->nullable();
            $table->string('apellido_materno',30)->nullable();
            $table->string('nombre',30)->nullable();
            $table->date('fecha_nacimiento')->nullable();
            $table->integer('edad')->nullable();
            $table->char('sexo',10)->nullable();
            $table->foreignId('estado_civil')->nullable()->constrained('estados_civiles')->onDelete('cascade');
            $table->string('direccion')->nullable();
            $table->string('colonia')->nullable();
            $table->string('ciudad')->nullable();
            $table->string('estado')->nullable();
            $table->string('pais')->nullable();
            $table->string('cp')->nullable();
            $table->string('correo_electronico',50)->nullable();
            $table->char('telefono',10)->nullable();
            $table->foreignId('colaborador_id')->constrained('colaboradores')->onDelete('cascade');
            $table->string('relacion');
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
        Schema::dropIfExists('familiar_colaborador');
    }
}
