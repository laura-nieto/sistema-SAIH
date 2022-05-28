<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateColaboradoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estados_civiles',function(Blueprint $table){
            $table->id();
            $table->string('nombre',10);
            $table->timestamps();
        });
        Schema::create('puesto_colaborador',function(Blueprint $table){
            $table->id();
            $table->string('nombre');
            $table->softDeletes('deleted_at');
            $table->timestamps();
        });
        Schema::create('departamento_colaborador',function(Blueprint $table){
            $table->id();
            $table->string('nombre');
            $table->softDeletes('deleted_at');
            $table->timestamps();
        });
        Schema::create('colaboradores', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('paciente_id')->unsigned()->nullable();
            $table->string('folio_tarjeta',30)->nullable();
            $table->foreignId('cliente_id')->nullable()->constrained('clientes')->onDelete('cascade');
            $table->string('apellido_paterno',30)->nullable();
            $table->string('apellido_materno',30)->nullable();
            $table->string('nombre',30)->nullable();
            $table->date('fecha_nacimiento')->nullable();
            $table->integer('edad')->nullable();
            $table->integer('meses')->nullable();
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
            // $table->foreignId('sucursal_id')->nullable()->constrained('sucursales')->onDelete('cascade');
            $table->foreignId('puesto_id')->nullable()->constrained('puesto_colaborador')->onDelete('cascade');
            $table->foreignId('departamento_id')->nullable()->constrained('departamento_colaborador')->onDelete('cascade');
            $table->softDeletes('deleted_at');
            $table->timestamps();
        });
        Schema::create('colaboradores_sucursales',function(Blueprint $table){
            $table->id();
            $table->foreignId('colaborador_id')->nullable()->constrained('colaboradores')->onDelete('cascade');
            $table->foreignId('sucursal_id')->nullable()->constrained('sucursales')->onDelete('cascade');
            $table->softDeletes('deleted_at');
            $table->timestamps();
        });
        Schema::create('especialidades_medicas',function(Blueprint $table){
            $table->id();
            $table->string('especialidad');
            $table->integer('bitCat_lugar')->nullable();
            $table->softDeletes('deleted_at');
            $table->timestamps();
        });
        Schema::create('medicos',function(Blueprint $table){
            $table->id();
            $table->string('doc_name')->nullable();
            $table->string('apellido_paterno');
            $table->string('apellido_materno');
            $table->string('nombre');
            $table->foreignId('especialidad_id')->nullable()->constrained('especialidades_medicas')->onDelete('cascade');
            $table->string('correo_electronico',50)->nullable();
            $table->char('telefono')->nullable();
            $table->char('celular')->nullable();
            $table->char('cedula_profesional')->nullable();
            $table->char('ssa')->nullable();
            $table->char('cedula_especialidad')->nullable();

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
        Schema::dropIfExists('colaboradores');
        Schema::dropIfExists('estados_civiles');
        Schema::dropIfExists('puesto_colaborador');
        Schema::dropIfExists('departamento_colaborador');
        Schema::dropIfExists('especialidades_medicas');
        Schema::dropIfExists('medicos');
    }
}
