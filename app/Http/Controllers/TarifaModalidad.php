<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ambiente;
use App\Area;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Modalidad;
use App\Tarifa;
use App\Proceso;
use DB;

class TarifaModalidad extends Controller
{

public function __construct()
    {
        $this->middleware('auth');
    }

  public function index()
    {
    	
       $tarifas = Tarifa::allactivo();
  
        return view('mantenimiento.tarifas')->with('tarifas', $tarifas);

    }

  public function listaTarifaModalidad(){
  	$tarifas = DB::table('tarifa')
                ->get();
  	return response()->json(['tarifas' => $tarifas]);
  }  
 
}
