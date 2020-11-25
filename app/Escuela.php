<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Escuela extends Model
{
	protected $table = 'escuela';
    
	public static function allactivo()
	{
		return Escuela::select('id as idescuela', 'descripcion')
    					->where('estado', '=', '1')
    					->get();
	}
}
