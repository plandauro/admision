<?php

namespace App;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
public static function allactivo()
	{
		return Area::select('id as idarea', 'descripcion')
    					->where('estado', '=', '1')
    					->get();
	}



  public static function getarea($isoarea){
    	return Area::select("id as idarea", "descripcion","nombre")
    					->where('estado','=','1')
    					->where('idarea', '=', $isoarea)
    					->get();
    }    protected $table = 'area';


}
