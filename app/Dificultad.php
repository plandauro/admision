<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dificultad extends Model
{
    //
    protected $table = 'dificultad';

    public static function allactivo()
	{
		return Dificultad::select('id as iddificultad','nombre')
                        ->where('estado','=','1')
    					->get();
	}
}
