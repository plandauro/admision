<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePoblacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('poblacion', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idfichasocioeconomica')->unsigned();
            $table->boolean('informante')->default(0);
            $table->string('apepaterno');
            $table->string('apematerno');
            $table->string('nombres');
            $table->date('fechanacimiento');
            $table->char('tipodocumento',2);
            $table->string('numerodocumento');
            $table->char('parentescojefe',2)->nullable();
            $table->char('numeronucleo',2)->nullable();
            $table->char('sexo',2);
            $table->boolean('gestante',2)->nullable();
            $table->char('estadocivil',2)->nullable();
            $table->boolean('seguroessalud')->nullable();
            $table->boolean('segurofapnp')->nullable();
            $table->boolean('seguroprivado')->nullable();
            $table->boolean('segurosis')->nullable();
            $table->boolean('segurootro')->nullable();
            $table->char('idiomaninez')->nullable();
            $table->boolean('sabeleer')->nullable();
            $table->char('niveleducativo',2)->nullable();
            $table->char('ultimogrado',2)->nullable();
            $table->char('ocupacionultimomes',2)->nullable();
            $table->char('sector',2)->nullable();
            $table->boolean('discapacidadvisual')->nullable();
            $table->boolean('discapacidadoir')->nullable();
            $table->boolean('discapacidadhablar')->nullable();
            $table->boolean('discapacidadusarbrazos')->nullable();
            $table->boolean('discapacidadmental')->nullable();
            $table->boolean('vasoleche')->nullable();
            $table->boolean('comedorpopular')->nullable();
            $table->boolean('comidaescolar')->nullable();
            $table->boolean('papilla')->nullable();
            $table->boolean('canastaalimentaria')->nullable();
            $table->boolean('juntos')->nullable();
            $table->boolean('techopropio')->nullable();
            $table->boolean('pension')->nullable();
            $table->boolean('cunamas')->nullable();
            $table->boolean('otros')->nullable();
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
