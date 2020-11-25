<?php

use Illuminate\Database\Seeder;

class FacultadTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('facultad')->insert([
            'descripcion' => "Facultad 01",
            'estado' => 1,
            'created_at' => new \DateTime()
        ]);
         DB::table('facultad')->insert([
            'descripcion' => "Facultad 02",
            'estado' => 1,
            'created_at' => new \DateTime()
        ]);
         DB::table('facultad')->insert([
            'descripcion' => "Facultad 03",
            'estado' => 1,
            'created_at' => new \DateTime()
        ]);
         DB::table('facultad')->insert([
            'descripcion' => "Facultad 04",
            'estado' => 1,
            'created_at' => new \DateTime()
        ]);
         DB::table('facultad')->insert([
            'descripcion' => "Facultad 05",
            'estado' => 1,
            'created_at' => new \DateTime()
        ]);
    }
}
