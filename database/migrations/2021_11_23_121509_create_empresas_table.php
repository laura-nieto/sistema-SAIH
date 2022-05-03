<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpresasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sucursales',function(Blueprint $table){
            $table->id();
            $table->string('nombre');
            $table->string('IP_sucursal')->nullable();
            $table->string('servidor_sucursal')->nullable();
            $table->string('base_de_datos')->nullable();
            $table->string('conexion_IP')->nullable();
            $table->softDeletes('deleted_at');
            $table->timestamps();
        });
        Schema::create('sucursales_usuarios',function(Blueprint $table){
            $table->id();
            $table->foreignId('sucursal_id')->nullable()->constrained('sucursales')->onDelete('cascade');
            $table->foreignId('usuario_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
        Schema::create('empresas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('direccion')->nullable();
            $table->string('dom_noExterior')->nullable();
            $table->string('dom_noInterior')->nullable();
            $table->string('colonia')->nullable();
            $table->string('RFC')->nullable();
            $table->string('telefono')->nullable();
            $table->string('ciudad')->nullable();
            $table->string('dom_municipio')->nullable();
            $table->string('dom_cp')->nullable();
            $table->string('dom_pais')->nullable();
            $table->string('dom_referencia')->nullable();
            $table->string('representante')->nullable();
            $table->softDeletes('deleted_at');
            $table->timestamps();
        });
        Schema::table('users',function(Blueprint $table){
            $table->foreignId('empresa_id')->nullable()->constrained('empresas')->onDelete('cascade');
        });
        Schema::create('servicios',function(Blueprint $table){
            $table->id();
            $table->string('nombre');
            $table->softDeletes('deleted_at');
            $table->timestamps();
        });
        Schema::create('tipo_membresia',function(Blueprint $table){
            $table->id();
            $table->string('nombre');
            $table->softDeletes('deleted_at');
            $table->timestamps();
        });
        Schema::create('clientes',function(Blueprint $table){
            $table->id();
            $table->string('nombre')->nullable();
            $table->string('razon_social')->nullable();
            $table->string('dom_calle')->nullable();
            $table->string('dom_noExterior')->nullable();
            $table->string('dom_noInterior')->nullable();
            $table->string('dom_colonia')->nullable();
            $table->string('dom_localidad')->nullable();
            $table->string('dom_municipio')->nullable();
            $table->string('dom_estado')->nullable();
            $table->string('dom_pais')->nullable();
            $table->string('dom_referencia')->nullable();
            $table->string('direccion')->nullable();
            $table->string('ciudad')->nullable();
            $table->string('RFC')->nullable();
            $table->integer('numero_precio')->nullable();
            $table->integer('cobrador_id')->nullable();
            $table->integer('dias_credito')->nullable();
            $table->string('cuenta')->nullable();
            $table->string('cp')->nullable();
            $table->string('telefono')->nullable();
            $table->string('correo_electronico')->nullable();
            $table->boolean('extranjero')->default(0);
            $table->boolean('descuento_general')->default(0);
            $table->foreignId('tipo_cliente')->nullable()->constrained('tipo_membresia')->onDelete('cascade');
            $table->softDeletes('deleted_at');
            $table->timestamps();
        });
        Schema::create('clientes_sucursales',function(Blueprint $table){
            $table->id();
            $table->foreignId('cliente_id')->nullable()->constrained('clientes')->onDelete('cascade');
            $table->foreignId('sucursal_id')->nullable()->constrained('sucursales')->onDelete('cascade');
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
        Schema::dropIfExists('sucursales');
        Schema::dropIfExists('tipo_membresia');
        Schema::dropIfExists('empresas');
        Schema::dropIfExists('empresas_sucursales');
        Schema::dropIfExists('servicios');
        Schema::dropIfExists('clientes');
    }
}
