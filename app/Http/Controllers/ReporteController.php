<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Postulacion;
use App\Proceso;
use App\Materia;
use App\Pagos;
use DB;

class ReporteController extends Controller
{



 public function repalumaula()
    {
        $procesos = Proceso::orderBy('id', 'desc')->get();
        return view('reporte.alumaula')->with("procesos", $procesos);
    }
    
    
    
    
    
    public function postulantes()
    {
        $procesos = Proceso::orderBy('id', 'desc')->get();
        return view('reporte.postulantes')->with("procesos", $procesos);
    }
    public function listPostulates(Request $request)
    {
        $postulacion = null;
        if($request->dato == 0)
            $request->tipo = 0;
        switch ($request->tipo) {
            case 1: #Por ambiente
            //MODIFICADO 17/09/2018
            /*$postulaciones = Postulacion::join('users', 'postulacion.idPostulante', '=', 'users.id')
                        ->join('escuela', 'postulacion.idescuela', '=', 'escuela.id')
                        ->leftJoin('ambiente', 'postulacion.idambiente', '=', 'ambiente.id')
                        ->join('tarifa', 'postulacion.idtarifa', '=', 'tarifa.id')
                        ->join('modalidad', 'tarifa.idmodalidad', '=', 'modalidad.id')
                        ->leftJoin('institucion_educativa', 'users.idinstitucioneducativa', '=', 'institucion_educativa.id')
                        ->join('area', 'escuela.idarea', '=', 'area.id')
                        ->select('users.id as idpostulante', 'users.nombre', 'users.apepaterno', 
                                'users.fechanacimiento', 'users.apematerno', 'users.dni',
                                'postulacion.id as idpostulacion', 'area.nombre as area', 'tarifa.descripcion as tarifa',
                                'escuela.descripcion as escuela', 'ambiente.descripcion as ambiente', 'modalidad.descripcion as modalidad', 'institucion_educativa.tipo as tipoie','postulacion.nroPostulante as codPostulantex')
                        ->where('postulacion.estado', 2)
                        ->where('ambiente.id', $request->dato)
                        ->where('postulacion.idproceso', $request->idproceso)
                        ->orderBy('apepaterno', 'asc')
                        ->get();
            */
                $postulaciones = Postulacion::join('users', 'postulacion.idPostulante', '=', 'users.id')
                        ->join('escuela', 'postulacion.idescuela', '=', 'escuela.id')
                        ->leftJoin('ambiente', 'postulacion.idambiente', '=', 'ambiente.id')
                        ->join('tarifa', 'postulacion.idtarifa', '=', 'tarifa.id')
                        ->join('modalidad', 'tarifa.idmodalidad', '=', 'modalidad.id')
                        ->leftJoin('institucion_educativa', 'users.idinstitucioneducativa', '=', 'institucion_educativa.id')
                        ->leftJoin('area', 'ambiente.idarea', '=', 'area.id')
                        ->select('users.id as idpostulante', 'users.nombre', 'users.apepaterno', 
                                'users.fechanacimiento', 'users.apematerno', 'users.dni',
                                'postulacion.id as idpostulacion', 'area.nombre as area', 'tarifa.descripcion as tarifa',
                                'escuela.descripcion as escuela', 'ambiente.descripcion as ambiente', 'modalidad.descripcion as modalidad', 'institucion_educativa.tipo as tipoie','postulacion.nroPostulante as codPostulantex')
                        ->where('postulacion.estado', 2)
                        ->where('ambiente.id', $request->dato)
                        ->where('postulacion.idproceso', $request->idproceso)
                        ->orderBy('apepaterno', 'asc')
                        ->get();
                break;
            case 2: #Por Escuela
            //MODIFICADO 17/09/2018
            /*$postulaciones = Postulacion::join('users', 'postulacion.idPostulante', '=', 'users.id')
                        ->join('escuela', 'postulacion.idescuela', '=', 'escuela.id')
                        ->leftJoin('ambiente', 'postulacion.idambiente', '=', 'ambiente.id')
                        ->join('tarifa', 'postulacion.idtarifa', '=', 'tarifa.id')
                        ->join('modalidad', 'tarifa.idmodalidad', '=', 'modalidad.id')
                        ->leftJoin('institucion_educativa', 'users.idinstitucioneducativa', '=', 'institucion_educativa.id')
                        ->join('area', 'escuela.idarea', '=', 'area.id')
                        ->select('users.id as idpostulante', 'users.nombre', 'users.apepaterno', 
                                'users.fechanacimiento', 'users.apematerno', 'users.dni',
                                'postulacion.id as idpostulacion', 'area.nombre as area','tarifa.descripcion as tarifa',
                                'escuela.descripcion as escuela', 'ambiente.descripcion as ambiente', 'modalidad.descripcion as modalidad', 'institucion_educativa.tipo as tipoie','postulacion.nroPostulante as codPostulantex')
                        ->where('postulacion.estado', 2)
                        ->where('escuela.id', $request->dato)
                        ->where('postulacion.idproceso', $request->idproceso)
                        ->get();*/
                $postulaciones = Postulacion::join('users', 'postulacion.idPostulante', '=', 'users.id')
                        ->join('escuela', 'postulacion.idescuela', '=', 'escuela.id')
                        ->leftJoin('ambiente', 'postulacion.idambiente', '=', 'ambiente.id')
                        ->join('tarifa', 'postulacion.idtarifa', '=', 'tarifa.id')
                        ->join('modalidad', 'tarifa.idmodalidad', '=', 'modalidad.id')
                        ->leftJoin('institucion_educativa', 'users.idinstitucioneducativa', '=', 'institucion_educativa.id')
                        ->leftJoin('area', 'ambiente.idarea', '=', 'area.id')
                        ->select('users.id as idpostulante', 'users.nombre', 'users.apepaterno', 
                                'users.fechanacimiento', 'users.apematerno', 'users.dni',
                                'postulacion.id as idpostulacion', 'area.nombre as area','tarifa.descripcion as tarifa',
                                'escuela.descripcion as escuela', 'ambiente.descripcion as ambiente', 'modalidad.descripcion as modalidad', 'institucion_educativa.tipo as tipoie','postulacion.nroPostulante as codPostulantex')
                        ->where('postulacion.estado', 2)
                        ->where('escuela.id', $request->dato)
                        ->where('postulacion.idproceso', $request->idproceso)
                        ->get();
                break;
            case 3: #Por modalidad
            //MODIFICADO 17/09/2018
            /*$postulaciones = Postulacion::join('users', 'postulacion.idPostulante', '=', 'users.id')
                        ->join('escuela', 'postulacion.idescuela', '=', 'escuela.id')
                        ->leftJoin('ambiente', 'postulacion.idambiente', '=', 'ambiente.id')
                        ->join('tarifa', 'postulacion.idtarifa', '=', 'tarifa.id')
                        ->join('modalidad', 'tarifa.idmodalidad', '=', 'modalidad.id')
                        ->leftJoin('institucion_educativa', 'users.idinstitucioneducativa', '=', 'institucion_educativa.id')
                        ->join('area', 'escuela.idarea', '=', 'area.id')
                        ->select('users.id as idpostulante', 'users.nombre', 'users.apepaterno', 
                                'users.fechanacimiento', 'users.apematerno', 'users.dni',
                                'postulacion.id as idpostulacion', 'area.nombre as area', 'tarifa.descripcion as tarifa',
                                'escuela.descripcion as escuela', 'ambiente.descripcion as ambiente', 'modalidad.descripcion as modalidad', 'institucion_educativa.tipo as tipoie','postulacion.nroPostulante as codPostulantex')
                        ->where('postulacion.estado', 2)
                        ->where('modalidad.id', $request->dato)
                        ->where('postulacion.idproceso', $request->idproceso)
                        ->get();*/
            
                $postulaciones = Postulacion::join('users', 'postulacion.idPostulante', '=', 'users.id')
                        ->join('escuela', 'postulacion.idescuela', '=', 'escuela.id')
                        ->leftJoin('ambiente', 'postulacion.idambiente', '=', 'ambiente.id')
                        ->join('tarifa', 'postulacion.idtarifa', '=', 'tarifa.id')
                        ->join('modalidad', 'tarifa.idmodalidad', '=', 'modalidad.id')
                        ->leftJoin('institucion_educativa', 'users.idinstitucioneducativa', '=', 'institucion_educativa.id')
                        ->leftJoin('area', 'ambiente.idarea', '=', 'area.id')
                        ->select('users.id as idpostulante', 'users.nombre', 'users.apepaterno', 
                                'users.fechanacimiento', 'users.apematerno', 'users.dni',
                                'postulacion.id as idpostulacion', 'area.nombre as area', 'tarifa.descripcion as tarifa',
                                'escuela.descripcion as escuela', 'ambiente.descripcion as ambiente', 'modalidad.descripcion as modalidad', 'institucion_educativa.tipo as tipoie','postulacion.nroPostulante as codPostulantex')
                        ->where('postulacion.estado', 2)
                        ->where('modalidad.id', $request->dato)
                        ->where('postulacion.idproceso', $request->idproceso)
                        ->get();
                break;
            case 4: #Por area
            //MODIFICADO 17/09/2018
            /*$postulaciones = Postulacion::join('users', 'postulacion.idPostulante', '=', 'users.id')
                        ->join('escuela', 'postulacion.idescuela', '=', 'escuela.id')
                        ->leftJoin('ambiente', 'postulacion.idambiente', '=', 'ambiente.id')
                        ->join('tarifa', 'postulacion.idtarifa', '=', 'tarifa.id')
                        ->join('modalidad', 'tarifa.idmodalidad', '=', 'modalidad.id')
                        ->leftJoin('institucion_educativa', 'users.idinstitucioneducativa', '=', 'institucion_educativa.id')
                        ->join('area', 'escuela.idarea', '=', 'area.id')
                        ->select('users.id as idpostulante', 'users.nombre', 'users.apepaterno', 
                                'users.fechanacimiento', 'users.apematerno', 'users.dni',
                                'postulacion.id as idpostulacion', 'area.nombre as area','tarifa.descripcion as tarifa',
                                'escuela.descripcion as escuela', 'ambiente.descripcion as ambiente', 'modalidad.descripcion as modalidad', 'institucion_educativa.tipo as tipoie','postulacion.nroPostulante as codPostulantex')
                        ->where('postulacion.estado', 2)
                        ->where('area.id', $request->dato)
                        ->where('postulacion.idproceso', $request->idproceso)
                        ->get();*/
                $postulaciones = Postulacion::join('users', 'postulacion.idPostulante', '=', 'users.id')
                        ->join('escuela', 'postulacion.idescuela', '=', 'escuela.id')
                        ->leftJoin('ambiente', 'postulacion.idambiente', '=', 'ambiente.id')
                        ->join('tarifa', 'postulacion.idtarifa', '=', 'tarifa.id')
                        ->join('modalidad', 'tarifa.idmodalidad', '=', 'modalidad.id')
                        ->leftJoin('institucion_educativa', 'users.idinstitucioneducativa', '=', 'institucion_educativa.id')
                        ->leftJoin('area', 'ambiente.idarea', '=', 'area.id')
                        ->select('users.id as idpostulante', 'users.nombre', 'users.apepaterno', 
                                'users.fechanacimiento', 'users.apematerno', 'users.dni',
                                'postulacion.id as idpostulacion', 'area.nombre as area','tarifa.descripcion as tarifa',
                                'escuela.descripcion as escuela', 'ambiente.descripcion as ambiente', 'modalidad.descripcion as modalidad', 'institucion_educativa.tipo as tipoie','postulacion.nroPostulante as codPostulantex')
                        ->where('postulacion.estado', 2)
                        ->where('area.id', $request->dato)
                        ->where('postulacion.idproceso', $request->idproceso)
                        ->get();
                break;
            default:
            //MODIFICADO 17/09/2018
            /*$postulaciones = Postulacion::join('users', 'postulacion.idPostulante', '=', 'users.id')
                        ->join('escuela', 'postulacion.idescuela', '=', 'escuela.id')
                        ->leftJoin('ambiente', 'postulacion.idambiente', '=', 'ambiente.id')
                        ->join('tarifa', 'postulacion.idtarifa', '=', 'tarifa.id')
                        ->join('modalidad', 'tarifa.idmodalidad', '=', 'modalidad.id')
                        ->leftJoin('institucion_educativa', 'users.idinstitucioneducativa', '=', 'institucion_educativa.id')
                        ->join('area', 'escuela.idarea', '=', 'area.id')
                        ->select('users.id as idpostulante', 'users.nombre', 'users.apepaterno', 
                                'users.fechanacimiento', 'users.apematerno', 'users.dni',
                                'postulacion.id as idpostulacion', 'area.nombre as area','tarifa.descripcion as tarifa',
                                'escuela.descripcion as escuela', 'ambiente.descripcion as ambiente', 'modalidad.descripcion as modalidad', 'institucion_educativa.tipo as tipoie','postulacion.nroPostulante as codPostulantex')
                        ->where('postulacion.estado', 2)
                        ->where('postulacion.idproceso', $request->idproceso)
                        ->get();*/
                $postulaciones = Postulacion::join('users', 'postulacion.idPostulante', '=', 'users.id')
                        ->join('escuela', 'postulacion.idescuela', '=', 'escuela.id')
                        ->leftJoin('ambiente', 'postulacion.idambiente', '=', 'ambiente.id')
                        ->join('tarifa', 'postulacion.idtarifa', '=', 'tarifa.id')
                        ->join('modalidad', 'tarifa.idmodalidad', '=', 'modalidad.id')
                        ->leftJoin('institucion_educativa', 'users.idinstitucioneducativa', '=', 'institucion_educativa.id')
                        ->leftJoin('area', 'ambiente.idarea', '=', 'area.id')
                        ->select('users.id as idpostulante', 'users.nombre', 'users.apepaterno', 
                                'users.fechanacimiento', 'users.apematerno', 'users.dni',
                                'postulacion.id as idpostulacion', 'area.nombre as area','tarifa.descripcion as tarifa',
                                'escuela.descripcion as escuela', 'ambiente.descripcion as ambiente', 'modalidad.descripcion as modalidad', 'institucion_educativa.tipo as tipoie','postulacion.nroPostulante as codPostulantex')
                        ->where('postulacion.estado', 2)
                        ->where('postulacion.idproceso', $request->idproceso)
                        ->get();
                break;
        }
        return response()->json(['postulaciones' => $postulaciones]);
    }

    public function cargaFiltro(Request $request)
    {
        $list = null;
        switch ($request->tipo) {
            case 1:
                 $list = Postulacion::join('ambiente', 'postulacion.idambiente', '=', 'ambiente.id')
                                    ->join('proceso as pr', 'postulacion.idProceso', '=', 'pr.id') 
                             ->select('ambiente.id as codigo', 'ambiente.descripcion as descripcion','pr.id as idProceso')
                             ->where('postulacion.idproceso', $request->idproceso)
                                  ->distinct()->get();
                break;
            case 2:
                $list = Postulacion::join('escuela', 'postulacion.idescuela', '=', 'escuela.id')
                        ->select('escuela.id as codigo', 'escuela.descripcion as descripcion')
                        ->distinct()->get();
                break;

            case 21:
                    $list = Postulacion::join('escuela', 'postulacion.idescuela', '=', 'escuela.id')
                            ->select('escuela.id as codigo', 'escuela.descripcion as descripcion')
                            ->whereIn('escuela.id', [4, 5, 6])
                            ->distinct()->get();
                    break;
            case 3:
                $list = Postulacion::join('tarifa', 'postulacion.idtarifa', '=', 'tarifa.id')
                        ->join('modalidad', 'tarifa.idmodalidad', '=', 'modalidad.id')
                        ->select('modalidad.id as codigo', 'modalidad.descripcion as descripcion')
                        ->distinct()->get();
                break;
            case 4:
            //MODIFICADO 17/09/2018
            /*$list = Postulacion::join('escuela', 'postulacion.idescuela', '=', 'escuela.id')
                        ->join('area', 'escuela.idarea', '=', 'area.id')
                        ->select('area.id as codigo', 'area.nombre as descripcion')
                        ->distinct()->get();*/
                $list = Postulacion::join('ambiente', 'postulacion.idambiente', '=', 'ambiente.id')
                        ->leftJoin('area', 'ambiente.idarea', '=', 'area.id')
                        ->select('area.id as codigo', 'area.nombre as descripcion')
                        ->distinct()->get();
                break;
                //AGREFADO 01/10/2018
             case 5:
                                    
                $list = json_decode('['.
                    '{"codigo":"1", "descripcion":"ASISTIO"},'.
                    '{"codigo":"2", "descripcion":"NO ASISTIO"}'.
                ']');
                break;
             case 6:
                $list = Materia::select('id as codigo','nombre as descripcion')
                        ->where('estado','=','1')
                        ->get();
                break;
         } ;
         return response()->json([
                                    'list' => $list,
                                ]);
    }

    public function estadistica()
    {
        $procesos = Proceso::orderBy('id', 'desc')->get();
        return view('reporte.estadistica')->with('procesos', $procesos);
    }

    public function listaEstadistica(Request $request)
    {
        $tipofiltro = $request->tipo;
        $resultado = Postulacion::join('users', 'postulacion.idPostulante', '=', 'users.id')
                                ->join('ubigeo', 'users.idubigeodireccion', '=', 'ubigeo.id')
                                ->select(DB::raw("
                                        (CASE 
                                        WHEN ".$tipofiltro." = 0 THEN ubigeo.departamento 
                                        WHEN ".$tipofiltro." = 1 THEN CONCAT(ubigeo.departamento,' - ',ubigeo.provincia) 
                                        WHEN ".$tipofiltro." = 2 THEN CONCAT(ubigeo.departamento,' - ',ubigeo.provincia,' - ',ubigeo.distrito)
                                        END) as ubicacion,
                                        COUNT(*) AS total,
                                        SUM(IF(resultado = 'INGRESO', 1, 0)) AS ingreso,
                                        SUM(IF(resultado = 'NO INGRESO', 1, 0)) AS noingreso")
                                )
                                ->where('postulacion.estado', '=', 2)
                                ->where('idproceso', $request->idproceso)
                                ->groupBy('ubicacion')
                                ->get();

        return response()->json(['resultado' => $resultado]);
    }

    public function pagos()
    {
        $procesos = Proceso::orderBy('id', 'desc')->get();
        return view('reporte.pagos')->with('procesos', $procesos);
    }
    public function listaPagos(Request $request)
    { 
    	//MODIFICADO 17/09/2018
	/*$postulaciones = Postulacion::join('proceso', 'postulacion.idproceso', '=', 'proceso.id')
                                    ->join('users', 'postulacion.idPostulante', '=', 'users.id')
                                    ->select('postulacion.id as idpostulacion', 'postulacion.costotarifa', 'postulacion.numerooperacion',
                                            'users.nombre', 'users.apepaterno', 'users.apematerno',
                                            'proceso.costocarpeta', 'proceso.costoprospecto', 
                                            DB::raw('proceso.costocarpeta+proceso.costoprospecto+postulacion.costotarifa as total'))
                                    ->where('postulacion.idproceso', $request->idproceso)
                                    ->whereIn('postulacion.estado', [2,3])
                                    ->get();*/
                                    
      	//MODIFICADO 26/09/2018
      	/*$postulaciones = Postulacion::join('proceso', 'postulacion.idproceso', '=', 'proceso.id')
                                    ->join('users', 'postulacion.idPostulante', '=', 'users.id')
                                    ->select('postulacion.id as idpostulacion', 'postulacion.costotarifa', 'postulacion.numerooperacion',
                                            'users.nombre', 'users.apepaterno', 'users.apematerno',
                                            'proceso.costocarpeta', 'proceso.costoprospecto', 
                                            DB::raw('postulacion.costotarifa as total'))
                                    ->where('postulacion.idproceso', $request->idproceso)
                                    ->whereIn('postulacion.estado', [2,3])
                                    ->get();*/
                                    
        $postulaciones = Postulacion::join('proceso', 'postulacion.idproceso', '=', 'proceso.id')
                                    ->join('users', 'postulacion.idPostulante', '=', 'users.id')
                                    ->select('postulacion.id as idpostulacion', 'postulacion.costotarifa', 'postulacion.numerooperacion','postulacion.nroPostulante as codPostulantex',
                                            'users.nombre', 'users.apepaterno', 'users.apematerno',
                                            'proceso.costocarpeta', 'proceso.costoprospecto', 
                                            DB::raw('postulacion.costotarifa as total'))
                                    ->where('postulacion.idproceso', $request->idproceso)
                                    ->whereIn('postulacion.estado', [2,3])
                                    ->get();
                                    
        return response()->json(['resultado' => $postulaciones]);
    }
    
    public function pagossubidos()
    {
        $procesos = Proceso::orderBy('id', 'desc')->get();
        return view('reporte.pagosexportado')->with('procesos', $procesos);
    }
    
    public function listaPagosSubidos(Request $request)
    { 
    	$proceso = DB::table('proceso')
                    ->select('descripcion')
                    ->where('id','=',$request->idproceso)
                    ->get();
                    
	    	$array = json_decode($proceso); 
	            $descripcion="" ;
	            foreach($array as $obj){
	                $descripcion = $obj->descripcion;                
	                }
	                //MODIFICADO 02/10/2018
    	/*    	
        $postulaciones = Pagos::select('pagos.id as idpostulacion','pagos.importepagado as costotarifa','pagos.numerooperacion as numerooperacion','pagos.numerodocumento as numerodocumento','pagos.numerodocumento as nombre', 'pagos.horapago as horapago', 'pagos.fechapago as fechapago','pagos.observacion as observacion','pagos.importepagado as costoprospecto',DB::raw('pagos.importepagado as total'))
                         ->where('pagos.estado',$descripcion)
                                    ->get();*/
        $postulaciones = (DB :: select( DB :: raw ("call sp_lista_pagos_subidos('$descripcion')")));                            
        return response()->json(['resultado' => $postulaciones]);
    }
    
    public function constancias($value='')
    {
        $procesos = Proceso::orderBy('id', 'desc')->get();
        return view('reporte.constancias')->with('procesos', $procesos);
    }
    public function listaConstancias(Request $request)
    {
        $resultado = Postulacion::join('escuela', 'postulacion.idescuela', '=', 'escuela.id')
                                ->select('postulacion.idproceso', 'escuela.id', 'escuela.descripcion', DB::raw("COUNT(*) AS cantidad"))
                                ->where('idproceso', $request->idproceso)
                                ->where('postulacion.resultado', 'INGRESO')
                                ->groupBy('postulacion.idproceso', 'escuela.id', 'descripcion')
                                ->get();
        return response()->json(['resultado' => $resultado]);
    }
    
    public function padron($value='')
    {
        $procesos = Proceso::orderBy('id', 'desc')->get();
        return view('reporte.padron')->with('procesos', $procesos);
    }
    public function listaPadron(Request $request)
    {
        $resultado = Postulacion::join('escuela', 'postulacion.idescuela', '=', 'escuela.id')
                                ->select('postulacion.idproceso', 'escuela.id', 'escuela.descripcion', DB::raw("COUNT(*) AS cantidad"))
                                ->where('idproceso', $request->idproceso)
                                ->where('postulacion.resultado', 'INGRESO')
                                ->groupBy('postulacion.idproceso', 'escuela.id', 'descripcion')
                                ->get();
        return response()->json(['resultado' => $resultado]);
    }
    
    public function padronpostulantes($value='')
    {
        $procesos = Proceso::orderBy('id', 'desc')->get();
        return view('reporte.padronpostulantes')->with('procesos', $procesos);
    }
    public function listaPadronPostulantes(Request $request)
    {
        $resultado = Postulacion::join('ambiente', 'postulacion.idambiente', '=', 'ambiente.id')
        			->join('area', 'ambiente.idarea', '=', 'area.id')
                                ->select('postulacion.idproceso', 'ambiente.id', 'ambiente.descripcion', 'area.nombre as nomarea','ambiente.capacidad', DB::raw("COUNT(*) AS cantidad"))
                                ->where('idproceso', $request->idproceso)
//                                ->where('postulacion.estado', 2)
                                ->whereIn('postulacion.estado', [1,2])
                                //AGREGADO 20/09/2018
                                ->where('postulacion.idtarifa','!=',17)
                                ->groupBy('postulacion.idproceso', 'ambiente.id', 'descripcion')
                                ->get();
        return response()->json(['resultado' => $resultado]);
    }
    
    public function ingresantes()
    {
        $procesos = Proceso::orderBy('id', 'desc')->get();
        return view('reporte.listaIngresantes')->with("procesos", $procesos);
    }
    public function listaIngresantes(Request $request)
    {
        $postulacion = null;
        if($request->dato == 0)
            $request->tipo = 0;
        switch ($request->tipo) {
            case 1:
                $postulaciones = Postulacion::join('users', 'postulacion.idPostulante', '=', 'users.id')
                        ->join('escuela', 'postulacion.idescuela', '=', 'escuela.id')
                        ->leftJoin('ambiente', 'postulacion.idambiente', '=', 'ambiente.id')
                        ->join('tarifa', 'postulacion.idtarifa', '=', 'tarifa.id')
                        ->join('modalidad', 'tarifa.idmodalidad', '=', 'modalidad.id')
                        ->leftJoin('institucion_educativa', 'users.idinstitucioneducativa', '=', 'institucion_educativa.id')
                        ->join('area', 'escuela.idarea', '=', 'area.id')
                        ->select('users.id as idpostulante', 'users.nombre', 'users.apepaterno', 'users.apematerno', 'area.nombre as area', 'tarifa.descripcion as tarifa',
                                'escuela.descripcion as escuela', 'ambiente.descripcion as ambiente', 'modalidad.descripcion as modalidad','postulacion.puntaje','postulacion.resultado','postulacion.codalumno','postulacion.omg','postulacion.ome','postulacion.idPostulante')
                        ->where('postulacion.estado', 2)
                        ->where('ambiente.id', $request->dato)
                        ->where('postulacion.idproceso', $request->idproceso)
                        ->where('postulacion.resultado','=','INGRESO')
                        ->get();
                break;
            default:
                $postulaciones = Postulacion::join('users', 'postulacion.idPostulante', '=', 'users.id')
                        ->join('escuela', 'postulacion.idescuela', '=', 'escuela.id')
                        ->leftJoin('ambiente', 'postulacion.idambiente', '=', 'ambiente.id')
                        ->join('tarifa', 'postulacion.idtarifa', '=', 'tarifa.id')
                        ->join('modalidad', 'tarifa.idmodalidad', '=', 'modalidad.id')
                        ->leftJoin('institucion_educativa', 'users.idinstitucioneducativa', '=', 'institucion_educativa.id')
                        ->join('area', 'escuela.idarea', '=', 'area.id')
                        ->select('users.id as idpostulante', 'users.nombre', 'users.apepaterno', 
                                'users.fechanacimiento', 'users.apematerno', 'users.dni',
                                'postulacion.id as idpostulacion', 'area.nombre as area','tarifa.descripcion as tarifa',
                                'escuela.descripcion as escuela', 'ambiente.descripcion as ambiente', 'modalidad.descripcion as modalidad', 'institucion_educativa.tipo as tipoie','postulacion.puntaje','postulacion.resultado','postulacion.codalumno','postulacion.omg','postulacion.ome','postulacion.idPostulante')
                        ->where('postulacion.estado', 2)
                        ->where('postulacion.idproceso', $request->idproceso)
                        ->where('postulacion.resultado','=','INGRESO')
                        ->get();
                break;
        }
        return response()->json(['postulaciones' => $postulaciones]);
    }
    public function postulantesvalidadonovalidado()
    {
        $procesos = Proceso::orderBy('id', 'desc')->get();
        return view('reporte.postulantevalidadonovalidado')->with('procesos', $procesos);
    }
   public function listvalnoval(Request $request)
    {
        $postulacion = null;
        if($request->dato == 0);
        switch ($request->dato) {
            case 1: #Validados
                $postulaciones = Postulacion::join('users', 'postulacion.idPostulante', '=', 'users.id')
                        ->join('escuela', 'postulacion.idescuela', '=', 'escuela.id')
                        ->leftJoin('ambiente', 'postulacion.idambiente', '=', 'ambiente.id')
                        ->join('tarifa', 'postulacion.idtarifa', '=', 'tarifa.id')
                        ->join('modalidad', 'tarifa.idmodalidad', '=', 'modalidad.id')
                        ->leftJoin('institucion_educativa', 'users.idinstitucioneducativa', '=', 'institucion_educativa.id')
                        ->join('area', 'escuela.idarea', '=', 'area.id')
                        ->select('users.id as idpostulante', 'users.nombre', 'users.apepaterno', 
                                'users.fechanacimiento', 'users.apematerno',
                                'postulacion.id as idpostulacion','postulacion.nroPostulante as idpostulacionX','area.nombre as area','tarifa.descripcion as tarifa', 'ambiente.descripcion as ambiente', 'modalidad.descripcion as modalidad','postulacion.estado','escuela.descripcion as escuela')
                        ->where('postulacion.estado',2)
                        ->where('postulacion.idproceso', $request->idproceso)
                        ->get();
                break;
            case 2: #No Validados
                $postulaciones = Postulacion::join('users', 'postulacion.idPostulante', '=', 'users.id')
                        ->join('escuela', 'postulacion.idescuela', '=', 'escuela.id')
                        ->leftJoin('ambiente', 'postulacion.idambiente', '=', 'ambiente.id')
                        ->join('tarifa', 'postulacion.idtarifa', '=', 'tarifa.id')
                        ->join('modalidad', 'tarifa.idmodalidad', '=', 'modalidad.id')
                        ->leftJoin('institucion_educativa', 'users.idinstitucioneducativa', '=', 'institucion_educativa.id')
                        ->join('area', 'escuela.idarea', '=', 'area.id')
                        ->select('users.id as idpostulante', 'users.nombre', 'users.apepaterno', 
                                'users.fechanacimiento', 'users.apematerno',
                                'postulacion.id as idpostulacion','postulacion.nroPostulante as idpostulacionX', 'area.nombre as area','tarifa.descripcion as tarifa', 'ambiente.descripcion as ambiente', 'modalidad.descripcion as modalidad','postulacion.estado','escuela.descripcion as escuela')
                        ->where('postulacion.estado',1)
                        ->where('postulacion.idproceso', $request->idproceso)
                        ->get();
                break;
            default:
                $postulaciones = Postulacion::join('users', 'postulacion.idPostulante', '=', 'users.id')
                        ->join('escuela', 'postulacion.idescuela', '=', 'escuela.id')
                        ->leftJoin('ambiente', 'postulacion.idambiente', '=', 'ambiente.id')
                        ->join('tarifa', 'postulacion.idtarifa', '=', 'tarifa.id')
                        ->join('modalidad', 'tarifa.idmodalidad', '=', 'modalidad.id')
                        ->leftJoin('institucion_educativa', 'users.idinstitucioneducativa', '=', 'institucion_educativa.id')
                        ->join('area', 'escuela.idarea', '=', 'area.id')
                        ->select('users.id as idpostulante', 'users.nombre', 'users.apepaterno', 
                                'users.fechanacimiento', 'users.apematerno',
                                'postulacion.id as idpostulacion','postulacion.nroPostulante as idpostulacionX', 'area.nombre as area','tarifa.descripcion as tarifa', 'ambiente.descripcion as ambiente', 'modalidad.descripcion as modalidad','postulacion.estado','escuela.descripcion as escuela')
                        ->where('postulacion.idproceso', $request->idproceso)
                        ->get();
                break;
        }
        return response()->json(['postulaciones' => $postulaciones]);
    }
    
    public function listPostulatesaulas(Request $request)
    {
        $postulacion = null;
        if($request->dato == 0)
            $request->tipo = 0;
        switch ($request->tipo) {
            case 1: #Por ambiente
                $postulaciones=(DB :: select( DB :: raw ("call sp_ambiente_orden($request->dato,$request->idproceso)")));
                break;
            default:
                $postulaciones = Postulacion::join('users', 'postulacion.idPostulante', '=', 'users.id')
                        ->join('escuela', 'postulacion.idescuela', '=', 'escuela.id')
                        ->leftJoin('ambiente', 'postulacion.idambiente', '=', 'ambiente.id')
                        ->join('tarifa', 'postulacion.idtarifa', '=', 'tarifa.id')
                        ->join('modalidad', 'tarifa.idmodalidad', '=', 'modalidad.id')
                        ->leftJoin('institucion_educativa', 'users.idinstitucioneducativa', '=', 'institucion_educativa.id')
                        ->join('area', 'escuela.idarea', '=', 'area.id')
                        ->select('users.id as idpostulante', 'users.nombre', 'users.apepaterno', 
                                'users.fechanacimiento', 'users.apematerno', 'users.dni',
                                'postulacion.id as idpostulacion', 'area.nombre as area','tarifa.descripcion as tarifa',
                                'escuela.descripcion as escuela', 'ambiente.descripcion as ambiente', 'modalidad.descripcion as modalidad', 'institucion_educativa.tipo as tipoie', 'postulacion.id as X')
                        ->where('postulacion.estado', 2)
                        ->where('postulacion.idproceso', $request->idproceso)
                        ->get();
                break;
        }
        return response()->json(['postulaciones' => $postulaciones]);
    }
    
    //AGREGADO 20/09/2018
    public function estadisticaEdad($value='')
    {
        $procesos = Proceso::orderBy('id', 'desc')->get();
        return view('reporte.estadisticapostulanteedad')->with('procesos', $procesos);
    }
    //AGREGADO 20/09/2018
    public function listaEstadisticaEdad(Request $request)
    {
        //por proceso
        $resultado = (DB :: select( DB :: raw ("call sp_estadistica_postulante_edad($request->idproceso)")));  
        
        return response()->json(['resultado' => $resultado]);
    }
    
    //AGREGADO 20/09/2018
    public function estadisticaEdadIngresante($value='')
    {
        $procesos = Proceso::orderBy('id', 'desc')->get();
        return view('reporte.estadisticaingresanteedad')->with('procesos', $procesos);
    }
    //AGREGADO 20/09/2018
    public function listaEstadisticaEdadIngresante(Request $request)
    {
        //por proceso
        $resultado = (DB :: select( DB :: raw ("call sp_estadistica_ingresante_edad($request->idproceso)")));  
        
        return response()->json(['resultado' => $resultado]);
    }
    
}
