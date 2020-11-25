<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFichaSocioeconomicaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ficha_socioeconomica', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('iduser')->unsigned();
            $table->string('idubigeo', 6);
            $table->string('centropoblado')->nullable();
            $table->string('codcentropoblado')->nullable();
            $table->string('categcentropoblado')->nullable();
            $table->string('nucleourbano')->nullable();
            $table->string('categnucleourbano')->nullable();
            $table->char('tipovia', 2)->nullable();
            $table->string('nombrevia')->nullable();
            $table->string('numeropuerta')->nullable();
            $table->string('block')->nullable();
            $table->string('piso')->nullable();
            $table->string('interior')->nullable();
            $table->string('manzana')->nullable();
            $table->string('lote')->nullable();
            $table->string('kilometro')->nullable();
            $table->string('telefono')->nullable();
            $table->char('tipovivienda', 2)->nullable();
            $table->string('tipoviviendaotro')->nullable();
            $table->char('suviviendaes', 2)->nullable();
            $table->string('suviviendaesotro')->nullable();
            $table->char('materialparedes', 2)->nullable();
            $table->string('materialparedesotro')->nullable();
            $table->char('materialtecho', 2)->nullable();
            $table->string('materialtechootro')->nullable();
            $table->char('materialpiso', 2)->nullable();
            $table->string('materialpisootro')->nullable();
            $table->char('tipoalumrado', 2)->nullable();
            $table->string('tipoalumradootro')->nullable();
            $table->char('abastecimientoagua', 2)->nullable();
            $table->string('abastecimientoaguaotro')->nullable();
            $table->char('serviciohigienico', 2)->nullable();
            $table->string('serviciohigienicootro')->nullable();
            $table->char('demorallegar', 2)->nullable();
            $table->string('demorallegarhoras')->nullable();
            $table->integer('cantidadhabitaciones')->nullable();
            $table->char('combustible', 2)->nullable();
            $table->string('combustibleotro')->nullable();
            $table->boolean('equiposonido')->nullable();
            $table->boolean('televisorcolor')->nullable();
            $table->boolean('dvd')->nullable();
            $table->boolean('licuadora')->nullable();
            $table->boolean('refrigeradora')->nullable();
            $table->boolean('cocinagas')->nullable();
            $table->boolean('telefonofijo')->nullable();
            $table->boolean('planchaelectrica')->nullable();
            $table->boolean('lavadora')->nullable();
            $table->boolean('computadora')->nullable();
            $table->boolean('hornomicroondas')->nullable();
            $table->boolean('internet')->nullable();
            $table->boolean('cable')->nullable();
            $table->boolean('celular')->nullable();
            $table->integer('cantidadhombres')->nullable();
            $table->integer('cantidadmujeres')->nullable();
            $table->boolean('cerrado')->default(false);
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
        //
    }
}
