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
        Schema::create('colaboradores', function (Blueprint $table) {
            $table->id();
            //$table->foreignId('miembro_id')->constrained('')->onDelete('cascade');
            $table->string('folio_tarjeta',30)->nullable();
            //$table->foreignId('cliente_id')->nullable()->constrained('')->onDelete('cascade');
            $table->string('apellido_paterno',30)->nullable();
            $table->string('apellido_materno',30)->nullable();
            $table->string('nombre',30)->nullable();
            $table->date('fecha_nacimiento')->nullable();
            $table->char('sexo',10)->nullable();
            $table->integer('estado_civil')->nullable();
            $table->string('correo_electronico',50)->nullable();
            $table->string('razon_desactivacion',30)->nullable();
            $table->char('status_cliente',10)->nullable();
            $table->char('telefono',10)->nullable();
            $table->foreignId('sucursal_id')->nullable()->constrained('sucursales')->onDelete('cascade');
            $table->foreignId('usuario_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->char('status',1)->nullable();

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
    }
}
