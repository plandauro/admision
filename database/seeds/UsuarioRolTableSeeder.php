<?php

use Illuminate\Database\Seeder;

class UsuarioRolTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('usuario_rol')->insert([
            'idrol' => 1,
            'iduser' => 1,
            'created_at' => new \DateTime()
        ]);

        DB::table('usuario_rol')->insert([
            'idrol' => 2,
            'iduser' => 2,
            'created_at' => new \DateTime()
        ]);
        DB::table('usuario_rol')->insert([
            'idrol' => 3,
            'iduser' => 3,
            'created_at' => new \DateTime()
        ]);
      /*  DB::table('usuario_rol')->insert([
            'idrol' => 5,
            'iduser' => 4,
            'created_at' => new \DateTime()
        ]);
        DB::table('usuario_rol')->insert([
            'idrol' => 6,
            'iduser' => 5,
            'created_at' => new \DateTime()
        ]);*/
    }
}
