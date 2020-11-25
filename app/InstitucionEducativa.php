<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InstitucionEducativa extends Model
{
    protected $table = 'institucion_educativa';

    public static function colegiosUbigeo($idubigeo){
    	return InstitucionEducativa::select("id as idie", "nombreie")
    					->where('idubigeo', 'like', $idubigeo)
    					->get();
    }
}
