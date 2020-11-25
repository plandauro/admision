<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProcesoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('proceso', function (Blueprint $table) {
            $table->increments('id');
            $table->string('descripcion');
            $table->boolean('activo');
            $table->boolean('activopostulacion');
            $table->decimal('costocarpeta',5,2);
            $table->decimal('costoprospecto',5,2);
            $table->string('responsable');
            $table->string('director');
            $table->date('fechaexaordinario');
            $table->date('fechaexaextraordinario');
            $table->string('resolucion');
            $table->date('fecharesolucion');
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
