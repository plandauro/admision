<?php

namespace App;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\User;
use DB;
class Hojarespuestacepre extends Model
{
    //MODIFICADO 25/09/2018
    //protected $table = 'hojarespuesta_cepre';
    //MODIFICADO 13/02/2019
    //protected $table = 'hojarespuesta_cepre_proceso';
    protected $table = 'hojarespuesta_cepre_proceso_4';
        
}
