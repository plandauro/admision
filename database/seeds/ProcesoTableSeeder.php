<?php

use Illuminate\Database\Seeder;

class ProcesoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('proceso')->insert([
            'descripcion' => "2018-I",
            'activo' => 1,
            'activopostulacion' => 1,
            'costocarpeta' => 10,
            'costoprospecto' => 40,
            'responsable' => 'Dr. Nicodemo C. Jamanca Gonzáles',
            'director' => 'Dr. Nicodemo C. Jamanca Gonzáles',
            'fechaexaordinario' => '2017/11/13',
            'fechaexaextraordinario' => '2017/11/13',
            'resolucion' => '123',
            'fecharesolucion' => '2017/10/1',
            'created_at' => new \DateTime()
        ]);
    }
}
