<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'nombre' => "Percy",
            'apepaterno' => "Chunga",
            'apematerno' => "Gamarra",
            'dni' => "4396828",
            'sexo' => 'M',
            'email' => 'pchunga@unab.edu.pe',
            'password' => bcrypt('pch43968281'),
            'created_at' => new \DateTime()
        ]);

       DB::table('users')->insert([
            'nombre' => "Coordinador",
            'apepaterno' => "Coordinador",
            'apematerno' => "Coordinador",
            'dni' => "11111111",
            'sexo' => 'M',
            'email' => 'coordinador@unab.edu.pe',
            'password' => bcrypt('UnaB2017'),
            'created_at' => new \DateTime()
        ]);

       DB::table('users')->insert([
            'nombre' => "Asistente",
            'apepaterno' => "Asistente",
            'apematerno' => "Asistente",
            'dni' => "22222222",
            'sexo' => 'M',
            'email' => 'asistente@unab.edu.pe',
            'password' => bcrypt('UnaB2017'),
            'created_at' => new \DateTime()
        ]);

    /*    DB::table('users')->insert([
            'nombre' => "Alumno",
            'apepaterno' => "Prueba",
            'apematerno' => "Prueba",
            'dni' => "33333333",
            'sexo' => 'M',
            'email' => 'alumno@unab.edu.pe',
            'password' => bcrypt('123456'),
            'created_at' => new \DateTime()
        ]);*/

       /* DB::table('users')->insert([
            'nombre' => "Postulante",
            'apepaterno' => "Prueba",
            'apematerno' => "Prueba",
            'dni' => "44444444",
            'sexo' => 'M',
            'email' => 'postulante@unab.edu.pe',
            'password' => bcrypt('123456'),
            'created_at' => new \DateTime()
        ]);*/
    }
}
