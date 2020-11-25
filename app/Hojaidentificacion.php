<?php

namespace App;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\User;
use DB;
class Hojaidentificacion extends Model
{

    //protected $table = 'hojaidenticacion';
    //MODIFICADO 17112018
	//protected $table = 'hojaidenticacion_proceso';
	//MODIFICADO 26032019
	protected $table = 'hojaidenticacion_proceso_2';
        
}
