<?php

use Illuminate\Database\Seeder;

class ModalidadTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('modalidad')->insert([
            'descripcion' => "Examen General",
            'estado' => 1,
            'created_at' => new \DateTime()
        ]);
        DB::table('modalidad')->insert([
            'descripcion' => "Examen Especial",
            'estado' => 1,
            'created_at' => new \DateTime()
        ]);
    }
}
