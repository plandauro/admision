<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proceso extends Model
{
	protected $table = 'proceso';

    public static function abierto()
    {
    	$proceso = Proceso::where('activo', '=', 1)->first();
    	if($proceso)
    		return $proceso;
    	else
    		return null;

    }
    
    
    public static function activo()
	{
		return Proceso::select('id', 'descripcion')
    					->where('activo', '=', '1')
    					->get();
	}

public static function activoID()
	{
		return Proceso::select('id')
    					->where('activo', '=', '1')
    					->get();
	}


}
