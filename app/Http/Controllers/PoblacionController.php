<?php

namespace App\Http\Controllers;
use App\Poblacion;
use App\FichaSocioeconomica;
use Validator;

use Illuminate\Http\Request;

class PoblacionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getPoblacion()
    {
    	$ficha = FichaSocioeconomica::where('iduser', Auth()->user()->id)->first();
    	$poblacion = Poblacion::select('id', 'apepaterno', 'apematerno', 'nombres', 'numerodocumento', 'sexo', 'parentescojefe', 'informante')
    							->where('idfichasocioeconomica', $ficha->id)
    							->get();
    	return response()->json(['poblacion'=>$poblacion]);
    }

    public function getPersona($idpersona)
    {
    	$persona = Poblacion::find($idpersona);
    	return response()->json(['persona'=>$persona]);
    }

    public function savePersona(Request $request)
    {
    	$poblacion = new Poblacion;
    	$validator = Validator::make($request->all(), $poblacion->rules, $poblacion->messages)->validate();

    	$ficha = FichaSocioeconomica::where('iduser', Auth()->user()->id)->first();
        if($request->idpersona == 0)
        	$persona = new Poblacion;
        else
        	$persona = Poblacion::find($request->idpersona);
        $persona->idfichasocioeconomica = $ficha->id;
        if($persona->informante == 1){
        	$persona->apepaterno = Auth()->user()->apepaterno;
	        $persona->apematerno = Auth()->user()->apematerno;
	        $persona->nombres = Auth()->user()->nombre;
	        $persona->fechanacimiento = Auth()->user()->fechanacimiento;
	        $persona->tipodocumento = 1;
	        $persona->numerodocumento = Auth()->user()->dni;
        }else{
        	$persona->apepaterno = $request->apepaterno;
	        $persona->apematerno = $request->apematerno;
	        $persona->nombres = $request->nombres;
	        $persona->fechanacimiento = $request->fechanacimiento;
	        $persona->tipodocumento = $request->tipodocumento;
	        $persona->numerodocumento = $request->numerodocumento;
        }
        
        $persona->parentescojefe = $request->parentescojefe;
        $persona->sexo = $request->sexo;
        $persona->gestante = $request->gestante;
        $persona->estadocivil = $request->estadocivil;
        $persona->seguroessalud = $request->seguroessalud;
        $persona->segurofapnp = $request->segurofapnp;
        $persona->seguroprivado = $request->seguroprivado;
        $persona->segurosis = $request->segurosis;
        $persona->segurootro = $request->segurootro;
        $persona->idiomaninez = $request->idiomaninez;
        $persona->sabeleer = $request->sabeleer;
        $persona->niveleducativo = $request->niveleducativo;
        $persona->ultimogrado = $request->ultimogrado;
        $persona->ocupacionultimomes = $request->ocupacionultimomes;
        $persona->sector = $request->sector;
        $persona->discapacidadvisual = $request->discapacidadvisual;
        $persona->discapacidadoir = $request->discapacidadoir;
        $persona->discapacidadhablar = $request->discapacidadhablar;
        $persona->discapacidadusarbrazos = $request->discapacidadusarbrazos;
        $persona->discapacidadmental = $request->discapacidadmental;
        $persona->vasoleche = $request->vasoleche;
        $persona->comedorpopular = $request->comedorpopular;
        $persona->comidaescolar = $request->comidaescolar;
        $persona->papilla = $request->papilla;
        $persona->canastaalimentaria = $request->canastaalimentaria;
        $persona->juntos = $request->juntos;
        $persona->techopropio = $request->techopropio;
        $persona->pension = $request->pension;
        $persona->cunamas = $request->cunamas;
        $persona->otros = $request->otros;
        if($persona->save())
        	return response()->json(['success'=> true]);
        else
        	return response()->json(['success'=> false]);
    }

    public function deletePersona(Request $request)
    {
    	$persona = Poblacion::find($request->idpersona);
    	if($persona->delete())
    		return response()->json(['success'=> true]);
    	else 
    		return response()->json(['success'=> false]);

    }

}
