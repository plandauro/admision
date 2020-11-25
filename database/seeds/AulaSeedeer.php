<?php

use Illuminate\Database\Seeder;

class AulaSeedeer extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('ambiente')->insert([
            'idarea' => 1,
            'capacidad' => 40,
            'descripcion' => 'PB01',
            'ubicacion' => '',
            'estado' => 1,
            'proyector' => 1,
            'created_at' => new \DateTime()
        ]);
        DB::table('ambiente')->insert([
            'idarea' => 1,
            'capacidad' => 40,
            'descripcion' => 'PB02',
            'ubicacion' => '',
            'estado' => 1,
            'proyector' => 1,
            'created_at' => new \DateTime()
        ]);
        DB::table('ambiente')->insert([
            'idarea' => 1,
            'capacidad' => 40,
            'descripcion' => 'PC03',
            'ubicacion' => '',
            'estado' => 1,
            'proyector' => 1,
            'created_at' => new \DateTime()
        ]);
        DB::table('ambiente')->insert([
            'idarea' => 1,
            'capacidad' => 40,
            'descripcion' => 'PC04',
            'ubicacion' => '',
            'estado' => 1,
            'proyector' => 1,
            'created_at' => new \DateTime()
        ]);
        DB::table('ambiente')->insert([
            'idarea' => 1,
            'capacidad' => 40,
            'descripcion' => 'PC05',
            'ubicacion' => '',
            'estado' => 1,
            'proyector' => 1,
            'created_at' => new \DateTime()
        ]);
        DB::table('ambiente')->insert([
            'idarea' => 2,
            'capacidad' => 40,
            'descripcion' => 'PE01',
            'ubicacion' => '',
            'estado' => 1,
            'proyector' => 1,
            'created_at' => new \DateTime()
        ]);
        DB::table('ambiente')->insert([
            'idarea' => 2,
            'capacidad' => 40,
            'descripcion' => 'PE02',
            'ubicacion' => '',
            'estado' => 1,
            'proyector' => 1,
            'created_at' => new \DateTime()
        ]);
        DB::table('ambiente')->insert([
            'idarea' => 2,
            'capacidad' => 40,
            'descripcion' => 'PE03',
            'ubicacion' => '',
            'estado' => 1,
            'proyector' => 1,
            'created_at' => new \DateTime()
        ]);
        DB::table('ambiente')->insert([
            'idarea' => 2,
            'capacidad' => 40,
            'descripcion' => 'PE04',
            'ubicacion' => '',
            'estado' => 1,
            'proyector' => 1,
            'created_at' => new \DateTime()
        ]);
        DB::table('ambiente')->insert([
            'idarea' => 2,
            'capacidad' => 40,
            'descripcion' => 'PE05',
            'ubicacion' => '',
            'estado' => 1,
            'proyector' => 1,
            'created_at' => new \DateTime()
        ]);
        DB::table('ambiente')->insert([
            'idarea' => 2,
            'capacidad' => 40,
            'descripcion' => 'PE06',
            'ubicacion' => '',
            'estado' => 1,
            'proyector' => 1,
            'created_at' => new \DateTime()
        ]);
        DB::table('ambiente')->insert([
            'idarea' => 3,
            'capacidad' => 40,
            'descripcion' => 'PA01',
            'ubicacion' => '',
            'estado' => 1,
            'proyector' => 1,
            'created_at' => new \DateTime()
        ]);
    }
}
