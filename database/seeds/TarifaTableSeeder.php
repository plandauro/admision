<?php

use Illuminate\Database\Seeder;

class TarifaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tarifa')->insert([
            'idmodalidad' => 1,
            'descripcion' => "Egresado I.E. Nacionales",
            'nota' => "Admisión",
            'costotarifa' => 200,
            'estado' => 1,
            'created_at' => new \DateTime()
        ]);
        DB::table('tarifa')->insert([
            'idmodalidad' => 1,
            'descripcion' => "Egresado I.E. Particulares",
            'nota' => "Admisión",
            'costotarifa' => 250,
            'estado' => 1,
            'created_at' => new \DateTime()
        ]);
        DB::table('tarifa')->insert([
            'idmodalidad' => 1,
            'descripcion' => "Cursando el 5to de Secundaria - I.E. Nacionales",
            'nota' => "Admisión",
            'costotarifa' => 200,
            'estado' => 1,
            'created_at' => new \DateTime()
        ]);
        DB::table('tarifa')->insert([
            'idmodalidad' => 1,
            'descripcion' => "Cursando el 5to de Secundaria - I.E. Particulares",
            'nota' => "Admisión",
            'costotarifa' => 250,
            'estado' => 1,
            'created_at' => new \DateTime()
        ]);
        DB::table('tarifa')->insert([
            'idmodalidad' => 1,
            'descripcion' => "Licenciados de la FF.AA. I.E. Nacionales",
            'nota' => "50%",
            'costotarifa' => 100,
            'estado' => 1,
            'created_at' => new \DateTime()
        ]);
        DB::table('tarifa')->insert([
            'idmodalidad' => 1,
            'descripcion' => "Licenciados de la FF.AA. I.E. Particulares",
            'nota' => "50%",
            'costotarifa' => 125,
            'estado' => 1,
            'created_at' => new \DateTime()
        ]);
        DB::table('tarifa')->insert([
            'idmodalidad' => 2,
            'descripcion' => "Traslado Externo",
            'nota' => "Admisión",
            'costotarifa' => 1000,
            'estado' => 1,
            'created_at' => new \DateTime()
        ]);
        DB::table('tarifa')->insert([
            'idmodalidad' => 2,
            'descripcion' => "Traslado Interno",
            'nota' => "Admisión",
            'costotarifa' => 400,
            'estado' => 1,
            'created_at' => new \DateTime()
        ]);
        DB::table('tarifa')->insert([
            'idmodalidad' => 2,
            'descripcion' => "Titulados y Graduados y/o Oficiales de la FF.AA. y PNP",
            'nota' => "Admisión",
            'costotarifa' => 1000,
            'estado' => 1,
            'created_at' => new \DateTime()
        ]);
        DB::table('tarifa')->insert([
            'idmodalidad' => 1,
            'descripcion' => "Primeros Puestos I.E. Nacionales",
            'nota' => "Admisión",
            'costotarifa' => 200,
            'estado' => 1,
            'created_at' => new \DateTime()
        ]);
        DB::table('tarifa')->insert([
            'idmodalidad' => 1,
            'descripcion' => "Primeros Puestos I.E. Particulares",
            'nota' => "Admisión",
            'costotarifa' => 250,
            'estado' => 1,
            'created_at' => new \DateTime()
        ]);
        DB::table('tarifa')->insert([
            'idmodalidad' => 1,
            'descripcion' => "Deportistas Calificados",
            'nota' => "Admisión",
            'costotarifa' => 250,
            'estado' => 1,
            'created_at' => new \DateTime()
        ]);
        DB::table('tarifa')->insert([
            'idmodalidad' => 1,
            'descripcion' => "Discapacitados I.E. Nacionales",
            'nota' => "Admisión",
            'costotarifa' => 200,
            'estado' => 1,
            'created_at' => new \DateTime()
        ]);
        DB::table('tarifa')->insert([
            'idmodalidad' => 1,
            'descripcion' => "Discapacitados I.E. Particulares",
            'nota' => "Admisión",
            'costotarifa' => 250,
            'estado' => 1,
            'created_at' => new \DateTime()
        ]);
        DB::table('tarifa')->insert([
            'idmodalidad' => 1,
            'descripcion' => "Victimas del terrorismo",
            'nota' => "Gratis",
            'costotarifa' => 0,
            'estado' => 1,
            'created_at' => new \DateTime()
        ]);
        DB::table('tarifa')->insert([
            'idmodalidad' => 1,
            'descripcion' => "Derecho de Admisión (sólo CEPRE-UNAB)",
            'nota' => "Alumnos del CEPRE.",
            'costotarifa' => 200,
            'estado' => 1,
            'created_at' => new \DateTime()
        ]);
    }
}
