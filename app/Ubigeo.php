<?php

namespace App;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Eloquent\Model;

class Ubigeo extends Model
{
    protected $table = 'ubigeo';


    public static function departamentos(){
    	return Ubigeo::select("id as iddepa", "departamento")
    					->where('id', 'like', '%0000')
    					->get();
    }

    public static function provincias($iddepartamento){
    	return Ubigeo::select("id as idprov", "provincia")
    					->where('id', 'like', substr($iddepartamento, 0, 2).'%00')
    					->where('id', '<>', $iddepartamento)
    					->get();
    }

    public static function distritos($idprovincia){
    	return Ubigeo::select("id as iddist", "distrito")
    					->where('id', 'like', substr($idprovincia, 0, 4).'%')
    					->where('id', '<>', $idprovincia)
    					->get();
    }

    public function getDepartamento($idubigeo){
        return Ubigeo::find(substr($idubigeo, 0, 2).'%0000');
    }
    public function getProvincia($idubigeo)
    {
        return Ubigeo::find(substr($idubigeo, 0, 4).'%00');
    }
    public function getDistrito($idubigeo)
    {
        return Ubigeo::find($idubigeo);
    }
}
