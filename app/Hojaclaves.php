<?php

namespace App;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\User;
use DB;
class Hojaclaves extends Model
{

    //protected $table = 'clave_solucionario';
    //MODFICIADO 17/11/2018
    //protected $table = 'clave_solucionario_proceso';
    protected $table = 'clave_solucionario_proceso_2';
        
}
