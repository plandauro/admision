<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForeignRelation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->foreign('idubigeocolegio')->references('id')->on('ubigeo');
            $table->foreign('idinstitucioneducativa')->references('id')->on('institucion_educativa');
            $table->foreign('idubigeonacimiento')->references('id')->on('ubigeo');
            $table->foreign('idubigeodireccion')->references('id')->on('ubigeo');
        });
        Schema::table('poblacion', function (Blueprint $table) {
            $table->foreign('idfichasocioeconomica')->references('id')->on('ficha_socioeconomica');
        });
        Schema::table('usuario_rol', function (Blueprint $table) {
            $table->foreign('idrol')->references('id')->on('rol');
            $table->foreign('iduser')->references('id')->on('users');
        });
        Schema::table('ficha_socioeconomica', function (Blueprint $table) {
            $table->foreign('iduser')->references('id')->on('users');
            $table->foreign('idubigeo')->references('id')->on('ubigeo');
        });
        Schema::table('institucion_educativa', function (Blueprint $table) {
            $table->foreign('idubigeo')->references('id')->on('ubigeo');
        });
        Schema::table('postulacion', function (Blueprint $table) {
            $table->foreign('idPostulante')->references('id')->on('users');
            $table->foreign('idVerificador')->references('id')->on('users');
            $table->foreign('idproceso')->references('id')->on('proceso');
            $table->foreign('idescuela')->references('id')->on('escuela');
            $table->foreign('idtarifa')->references('id')->on('tarifa');
            $table->foreign('idambiente')->references('id')->on('ambiente');
        });
        Schema::table('escuela', function (Blueprint $table) {
            $table->foreign('idfacultad')->references('id')->on('facultad');
            $table->foreign('idarea')->references('id')->on('area');
        });
        Schema::table('tarifa', function (Blueprint $table) {
            $table->foreign('idmodalidad')->references('id')->on('modalidad');
        });
         Schema::table('ambiente', function (Blueprint $table) {
            $table->foreign('idarea')->references('id')->on('area');
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
