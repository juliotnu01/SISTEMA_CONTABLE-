<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpresasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresas', function (Blueprint $table) {
            $table->increments('id');

            $table->string('nombre',200)->nullable();
            $table->string('nit',200)->nullable();
            $table->string('dig_verificacion',200)->nullable();
            $table->string('codCgn',200)->nullable();
            $table->string('nombreRepresentanteLegal',200)->nullable();
            $table->integer('cedulaRepresentanteLegal',20)->nullable();
            $table->integer('noTPRepresentanteLegal',20)->nullable();

            $table->string('nombreContador',200)->nullable();
            $table->integer('cedulaContador',20)->nullable();
            $table->integer('noTpContador',20)->nullable();

            $table->string('nombreRevisorFiscal',200)->nullable();
            $table->integer('cedulaRevisorFiscal',20)->nullable();
            $table->integer('noTPRevisorFiscal',20)->nullable();

            $table->string('nombreControlInterno',200)->nullable();
            $table->integer('cedulaControlInterno',20)->nullable();
            $table->integer('noTPControlInterno',20)->nullable();

            $table->string('jefePresupuesto',200)->nullable();
            $table->integer('cedulaJefePresupuesto',20)->nullable();
            $table->integer('noTPJefePresupuesto',20)->nullable();

            $table->string('otroResponsable',200)->nullable();
            $table->string('nombreOtroResponsable',200)->nullable();
            $table->integer('cedulaJefePresupuesto',20)->nullable();
            $table->integer('noTPOtroResponsable',20)->nullable();

            $table->string('marco_normativo',200)->nullable();
            $table->string('direccion',200)->nullable();
            $table->string('telefono',200)->nullable();
            $table->string('correo',200)->nullable();
            $table->string('url',200)->nullable();
            $table->longText('lema')->nullable();
            $table->string('logo_republica',500)->nullable();
            $table->string('logo_municipio',500)->nullable();
            $table->string('logo_plandesarrollo',500)->nullable();
            $table->integer('num_ingresoinicial')->nullable();
            $table->integer('num_ingresoactual')->nullable();
            $table->string('vigencia_cdp',500)->nullable();

            $table->integer('id_ciudad')->unsigned();
            $table->integer('id_departamento')->unsigned();

            $table->foreign('id_departamento')->references('id')->on('departamentos');
            $table->foreign('id_ciudad')->references('id')->on('ciudades');

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
