<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tarifa extends Model
{
	protected $table='tarifa';

	public static function allactivo()
	{
		return Tarifa::select('id as idtarifa','descripcion','nota','costotarifa','idmodalidad')
                                        ->where('estado','=','1')
    					->get();
	}
}
