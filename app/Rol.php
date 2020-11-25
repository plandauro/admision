<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    protected $table = 'rol';


public static function allactivo()
	{
		return Rol::select('id as idrol', 'nombre')
    					->get();
	}

  public static function getrol($rolusu){
    	return Rol::select("id as idusu","nombre")   					
    					->where('idusu', '=',$rolusu)
    					->get();
    }

}
