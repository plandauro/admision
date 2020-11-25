<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Modalidad extends Model
{
   protected $table = 'modalidad';
   
   public static function allactivo()
   {
   		return modalidad::select('id as idmodalidad','descripcion as descripcionmodalidad')
   		->where('estado','=','1')
   		->get();
   }

}
