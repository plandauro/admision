<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostulacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('postulacion', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idPostulante')->unsigned();
            $table->integer('idVerificador')->unsigned()->nullable();
            $table->integer('idproceso')->unsigned();
            $table->integer('idescuela')->unsigned();
            $table->integer('idtarifa')->unsigned();
            $table->integer('idambiente')->unsigned()->nullable();
            $table->boolean('estado');
            $table->decimal('costotarifa',8,2);
            $table->integer('medioseentero');
            $table->integer('dondesepreparo');
            $table->string('numerooperacion')->nullable();
            $table->integer('omg')->nullable();
            $table->integer('ome')->nullable();
            $table->decimal('puntaje', 5,2)->nullable();
            $table->string('resultado')->nullable();
            $table->string('codalumno')->nullable();
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
