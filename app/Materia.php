<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Materia extends Model
{
    //
    protected $table = 'materia';

    public static function allactivo()
	{
		return Materia::select('id as idmateria','nombre')
                        ->where('estado','=','1')
    					->get();
	}
}
