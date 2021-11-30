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
            $table->softDeletes('deleted_at');
            $table->timestamps();
        });
        Schema::create('empresas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->softDeletes('deleted_at');
            $table->timestamps();
        });
        Schema::create('empresas_sucursales',function(Blueprint $table){
            $table->id();
            $table->foreignId('empresa_id')->nullable()->constrained('empresas')->onDelete('cascade');
            $table->foreignId('sucursal_id')->nullable()->constrained('sucursales')->onDelete('cascade');
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
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('empresas');
    }
}
