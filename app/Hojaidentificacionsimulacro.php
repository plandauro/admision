<?php

namespace App;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\User;
use DB;
class Hojaidentificacionsimulacro extends Model
{
	//MODIFICADO 16/10/2018
	//protected $table = 'hojaidenticacion_simulacro';
	//protected $table = 'hojaidenticacion_simulacro_proceso';        
	//MODIFICADO 19/03/2019
	//protected $table = 'hojaidenticacion_simulacro_proceso_3';    
	//MODIFICADO 25/10/2019
	//protected $table = 'hojaidenticacion_simulacro_proceso_2020_1';    
	//MODIFICADO 06/03/2020
	protected $table = 'hojaidenticacion_simulacro_proceso_2020_2';    
}
