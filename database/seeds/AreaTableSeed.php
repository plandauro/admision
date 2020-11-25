<?php

use Illuminate\Database\Seeder;

class AreaTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('area')->insert([
            'descripcion' => "A",
            'nombre' => "Ciencias",
            'estado' => 1,
            'created_at' => new \DateTime()
        ]);
        DB::table('area')->insert([
            'descripcion' => "B",
            'nombre' => "Letras",
            'estado' => 1,
            'created_at' => new \DateTime()
        ]);
        DB::table('area')->insert([
            'descripcion' => "C",
            'nombre' => "Especiales",
            'estado' => 1,
            'created_at' => new \DateTime()
        ]);
    }
}
