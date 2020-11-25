<?php

namespace App;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use DB;
class Evaluacion extends Model
{
public static function allactivo()
	{
		return Evaluacion::select('*')
    					->where('estado', '=', '1')
    					->get();
	}
}
