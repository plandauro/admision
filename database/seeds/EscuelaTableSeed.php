<?php

use Illuminate\Database\Seeder;

class EscuelaTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('escuela')->insert([
            'idarea' => 1,
            'idfacultad' => 1,
            'descripcion' => "CONTABILIDAD Y FINANZAS",
            'estado' => 1,
            'created_at' => new \DateTime()
        ]);
        DB::table('escuela')->insert([
            'idarea' => 1,
            'idfacultad' => 4,
            'descripcion' => "DERECHO Y CIENCIA POLÍTICA",
            'estado' => 1,
            'created_at' => new \DateTime()
        ]);
        DB::table('escuela')->insert([
            'idarea' => 2,
            'idfacultad' => 2,
            'descripcion' => "ENFERMERÍA",
            'estado' => 1,
            'created_at' => new \DateTime()
        ]);
        DB::table('escuela')->insert([
            'idarea' => 2,
            'idfacultad' => 5,
            'descripcion' => "INGENIERÍA AGRÓNOMA",
            'estado' => 1,
            'created_at' => new \DateTime()
        ]);
        DB::table('escuela')->insert([
            'idarea' => 2,
            'idfacultad' => 5,
            'descripcion' => "INGENIERÍA CIVIL",
            'estado' => 1,
            'created_at' => new \DateTime()
        ]);
        DB::table('escuela')->insert([
            'idarea' => 2,
            'idfacultad' => 5,
            'descripcion' => "INGENIERÍA EN INDUSTRIAS ALIMENTARIAS",
            'estado' => 1,
            'created_at' => new \DateTime()
        ]);
        DB::table('escuela')->insert([
            'idarea' => 2,
            'idfacultad' => 2,
            'descripcion' => "OBSTETRICIA",
            'estado' => 1,
            'created_at' => new \DateTime()
        ]);
    }
}
