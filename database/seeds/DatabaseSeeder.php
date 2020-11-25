<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(RolTableSeeder::class);
        $this->call(UsuarioRolTableSeeder::class);
        $this->call(UbigeoTableSeeder::class);
        $this->call(InstitucionEducativaSeeder::class);
        $this->call(ModalidadTableSeeder::class);
        $this->call(TarifaTableSeeder::class);
        $this->call(ProcesoTableSeeder::class);
        $this->call(FacultadTableSeed::class);
        $this->call(AreaTableSeed::class);
        $this->call(EscuelaTableSeed::class);
        $this->call(AulaSeedeer::class);
    }
}
