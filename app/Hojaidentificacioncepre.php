<?php

namespace App;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\User;
use DB;
class Hojaidentificacioncepre extends Model
{
    //MOFIDICADO 25/09/2018
    //protected $table = 'hojaidenticacion_cepre';
    //MOFIDICADO 13/02/2019
    //protected $table = 'hojaidenticacion_cepre_proceso';
    protected $table = 'hojaidenticacion_cepre_proceso_4';
        
}
