<?php

use Illuminate\Database\Seeder;

class RolTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('rol')->insert([
            'nombre' => "Administador",
            'descripcion' => "",
            'created_at' => new \DateTime()
        ]);
        DB::table('rol')->insert([
            'nombre' => "Coordinador",
            'descripcion' => "",
            'created_at' => new \DateTime()
        ]);
        DB::table('rol')->insert([
            'nombre' => "Asistente",
            'descripcion' => "",
            'created_at' => new \DateTime()
        ]);
        DB::table('rol')->insert([
            'nombre' => "Docente",
            'descripcion' => "",
            'created_at' => new \DateTime()
        ]);
        DB::table('rol')->insert([
            'nombre' => "Alumno",
            'descripcion' => "",
            'created_at' => new \DateTime()
        ]);
        DB::table('rol')->insert([
            'nombre' => "Postulante",
            'descripcion' => "",
            'created_at' => new \DateTime()
        ]);
    }
}
