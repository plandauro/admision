<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use App\Ubigeo;
use App\InstitucionEducativa;
use App\Postulacion;
use App\Pagos;
use App\vPostulacion;
use App\User;
use App\Tarifa;
use App\Escuela;
use App\Proceso;
use App\Area;
use App\Ambiente;
use App\Modalidad;
use App\Hojaidentificacion;
use App\Hojarespuesta;
use App\Hojaclaves;
use App\Hojaidentificacioncepre;
use App\Hojarespuestacepre;
use App\Hojaclavescepre;
use App\HojaidentificacioncepreII;
use App\HojarespuestacepreII;
use App\HojaclavescepreII;
use App\Hojaidentificacionsimulacro;
use App\Hojarespuestasimulacro;
use App\Hojaclavessimulacro;
use Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Facades\Excel;
use Storage;
use File;
use DB;

class TxtController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function cargarCalificacion()
    {
        if (!Proceso::abierto())
            return redirect("/");
        $procesos = Proceso::orderBy('id', 'desc')->get();
        return view("calificacion")->with("procesos", $procesos);
    }

    public function cargarInformacion()
    {
        if (!Proceso::abierto())
            return redirect("/");
        // return view("cargartxt");
        $procesos = Proceso::orderBy('id', 'desc')->get();
        return view('cargartxt')->with('procesos', $procesos);
    }

    public function cargarInformacion20202()
    {
        if (!Proceso::abierto())
            return redirect("/");
        //return view("cargartxt-2020-2");
        $procesos = Proceso::orderBy('id', 'desc')->get();
        return view('cargartxt-2020-2')->with('procesos', $procesos);
    }
    public function cargarInformacion20202E()
    {
        if (!Proceso::abierto())
            return redirect("/");
        //return view("cargartxt-2020-2");
        $procesos = Proceso::orderBy('id', 'desc')->get();
        return view('cargartxt-2020-2-E')->with('procesos', $procesos);
    }

    public function cargarInformacionCepre()
    {
        if (!Proceso::abierto())
            return redirect("/");
        //return view("cargartxt");
        $procesos = Proceso::orderBy('id', 'desc')->get();
        return view('cargartxtcepre')->with('procesos', $procesos);
    }

    public function cargarInformacionSimulacro()
    {
        if (!Proceso::abierto())
            return redirect("/");
        //return view("cargartxt");
        $procesos = Proceso::orderBy('id', 'desc')->get();
        return view('cargartxtsimulacro')->with('procesos', $procesos);
    }

    public function listacalificacion(Request $request)
    {
        $resultado = Postulacion::join('escuela', 'postulacion.idescuela', '=', 'escuela.id')
            ->select('postulacion.idproceso', 'escuela.id', 'escuela.descripcion', DB::raw("COUNT(*) AS cantidad"))
            ->where('idproceso', $request->idproceso)
            ->where('postulacion.resultado', 'INGRESO')
            ->groupBy('postulacion.idproceso', 'escuela.id', 'descripcion')
            ->get();
        return response()->json(['resultado' => $resultado]);
    }

    public function postulantes()
    {
        $procesos = Proceso::orderBy('id', 'desc')->get();
        return view('calificacion')->with("procesos", $procesos);
    }

    public function postulantes2020II()
    {
        $procesos = Proceso::orderBy('id', 'desc')->get();
        return view('calificacion_2020_2')->with("procesos", $procesos);
    }

    public function postulantes2020II_canal_A()
    {
        $procesos = Proceso::orderBy('id', 'desc')->get();
        return view('calificacion_2020_2_canal_A')->with("procesos", $procesos);
    }

    public function postulantes2020II_canal_B()
    {
        $procesos = Proceso::orderBy('id', 'desc')->get();
        return view('calificacion_2020_2_canal_B')->with("procesos", $procesos);
    }

    public function postulantes2020II_canal_C()
    {
        $procesos = Proceso::orderBy('id', 'desc')->get();
        return view('calificacion_2020_2_canal_C')->with("procesos", $procesos);
    }

    public function postulantes2020II_canal_D()
    {
        $procesos = Proceso::orderBy('id', 'desc')->get();
        return view('calificacion_2020_2_canal_D')->with("procesos", $procesos);
    }

    // INICIO PARA EXAMEN ESPECIAL
    public function postulantes2020IIESPECIAL()
    {
        $procesos = Proceso::orderBy('id', 'desc')->get();
        return view('calificacion_2020_2_especial')->with("procesos", $procesos);
    }

    public function listPostulates2020IIESPECIAL(Request $request)
    {
        $postulacion = null;
        if ($request->dato == 0)
            $request->tipo = 0;
        switch ($request->tipo) {
            case 2: #Por Escuela
                // $postulaciones = Postulacion::join('users', 'postulacion.idPostulante', '=', 'users.id')
                //     ->join('escuela', 'postulacion.idescuela', '=', 'escuela.id')
                //     ->leftJoin('ambiente', 'postulacion.idambiente', '=', 'ambiente.id')
                //     ->join('tarifa', 'postulacion.idtarifa', '=', 'tarifa.id')
                //     ->join('modalidad', 'tarifa.idmodalidad', '=', 'modalidad.id')
                //     ->join('area', 'escuela.idarea', '=', 'area.id')
                //     ->select(
                //         'users.id as idpostulante',
                //         'users.nombre',
                //         'users.apepaterno',
                //         'users.fechanacimiento',
                //         'users.apematerno',
                //         'users.dni',
                //         'postulacion.id as idpostulacion',
                //         'area.nombre as area',
                //         'tarifa.descripcion as tarifa',
                //         'escuela.descripcion as escuela',
                //         'ambiente.descripcion as ambiente',
                //         'modalidad.descripcion as modalidad',
                //         'institucion_educativa.tipo as tipoie',
                //         'postulacion.resultado as resultado'
                //     )
                //     ->where('postulacion.estado', 2)
                //     ->where('escuela.id', $request->dato)
                //     ->where('postulacion.idproceso', $request->idproceso)
                //     ->get();

                $postulaciones = (DB::select(DB::raw("call  sp_calificar_escuela_proceso_2020_2($request->dato)")));
                break;

            default:

                //$postulaciones=(DB :: select( DB :: raw ("call sp_calificar_admision()")));
                $postulaciones = (DB::select(DB::raw("call sp_calificar_proceso_2020_2_E()")));

                //$postulaciones=(DB :: select( DB :: raw ("call sp_calificar_canal()")));
                break;
        }
        return response()->json(['postulaciones' => $postulaciones]);
    }

    public function procesoRespuesta2020IIESPECIAL()
    {

        DB::statement('call sp_insercion_calificar_proceso_2020_2_E()');

        return redirect('rep-calificacion-2020-2-especial'); //CALIFICACION 2020 - 2 ESPECIAL

        // return redirect('rep-calificacion');	//ALIFICACION ANTIGUA

    }
    //FIN EXAMEN ESPECIAL

    public function listPostulates(Request $request)
    {
        $postulacion = null;
        if ($request->dato == 0)
            $request->tipo = 0;
        switch ($request->tipo) {
            case 2: #Por Escuela
                $postulaciones = Postulacion::join('users', 'postulacion.idPostulante', '=', 'users.id')
                    ->join('escuela', 'postulacion.idescuela', '=', 'escuela.id')
                    ->leftJoin('ambiente', 'postulacion.idambiente', '=', 'ambiente.id')
                    ->join('tarifa', 'postulacion.idtarifa', '=', 'tarifa.id')
                    ->join('modalidad', 'tarifa.idmodalidad', '=', 'modalidad.id')
                    ->leftJoin('institucion_educativa', 'users.idinstitucioneducativa', '=', 'institucion_educativa.id')
                    ->join('area', 'escuela.idarea', '=', 'area.id')
                    ->select(
                        'users.id as idpostulante',
                        'users.nombre',
                        'users.apepaterno',
                        'users.fechanacimiento',
                        'users.apematerno',
                        'users.dni',
                        'postulacion.id as idpostulacion',
                        'area.nombre as area',
                        'tarifa.descripcion as tarifa',
                        'escuela.descripcion as escuela',
                        'ambiente.descripcion as ambiente',
                        'modalidad.descripcion as modalidad',
                        'institucion_educativa.tipo as tipoie',
                        'postulacion.resultado as resultado'
                    )
                    ->where('postulacion.estado', 2)
                    ->where('escuela.id', $request->dato)
                    ->where('postulacion.idproceso', $request->idproceso)
                    ->get();
                break;
            default:


                //$postulaciones=(DB :: select( DB :: raw ("call sp_calificar_admision()")));
                $postulaciones = (DB::select(DB::raw("call sp_calificar_simulacro_admision()")));

                //$postulaciones=(DB :: select( DB :: raw ("call sp_calificar_canal()")));
                break;
        }
        return response()->json(['postulaciones' => $postulaciones]);
    }

    public function listPostulates2020II(Request $request)
    {
        $postulacion = null;
        if ($request->dato == 0)
            $request->tipo = 0;
        switch ($request->tipo) {
            case 2: #Por Escuela
                // $postulaciones = Postulacion::join('users', 'postulacion.idPostulante', '=', 'users.id')
                //     ->join('escuela', 'postulacion.idescuela', '=', 'escuela.id')
                //     ->leftJoin('ambiente', 'postulacion.idambiente', '=', 'ambiente.id')
                //     ->join('tarifa', 'postulacion.idtarifa', '=', 'tarifa.id')
                //     ->join('modalidad', 'tarifa.idmodalidad', '=', 'modalidad.id')
                //     ->join('area', 'escuela.idarea', '=', 'area.id')
                //     ->select(
                //         'users.id as idpostulante',
                //         'users.nombre',
                //         'users.apepaterno',
                //         'users.fechanacimiento',
                //         'users.apematerno',
                //         'users.dni',
                //         'postulacion.id as idpostulacion',
                //         'area.nombre as area',
                //         'tarifa.descripcion as tarifa',
                //         'escuela.descripcion as escuela',
                //         'ambiente.descripcion as ambiente',
                //         'modalidad.descripcion as modalidad',
                //         'institucion_educativa.tipo as tipoie',
                //         'postulacion.resultado as resultado'
                //     )
                //     ->where('postulacion.estado', 2)
                //     ->where('escuela.id', $request->dato)
                //     ->where('postulacion.idproceso', $request->idproceso)
                //     ->get();

                $postulaciones = (DB::select(DB::raw("call  sp_calificar_escuela_proceso_2020_2($request->dato)")));

                break;
            default:


                //$postulaciones=(DB :: select( DB :: raw ("call sp_calificar_admision()")));
                $postulaciones = (DB::select(DB::raw("call sp_calificar_proceso_2020_2()")));

                //$postulaciones=(DB :: select( DB :: raw ("call sp_calificar_canal()")));
                break;
        }
        return response()->json(['postulaciones' => $postulaciones]);
    }

    public function listPostulates2020II_canal_A(Request $request)
    {
        $postulacion = null;
        if ($request->dato == 0)
            $request->tipo = 0;
        switch ($request->tipo) {
            case 21: #Por Escuela
                // $postulaciones = Postulacion::join('users', 'postulacion.idPostulante', '=', 'users.id')
                //     ->join('escuela', 'postulacion.idescuela', '=', 'escuela.id')
                //     ->leftJoin('ambiente', 'postulacion.idambiente', '=', 'ambiente.id')
                //     ->join('tarifa', 'postulacion.idtarifa', '=', 'tarifa.id')
                //     ->join('modalidad', 'tarifa.idmodalidad', '=', 'modalidad.id')
                //     ->join('area', 'escuela.idarea', '=', 'area.id')
                //     ->select(
                //         'users.id as idpostulante',
                //         'users.nombre',
                //         'users.apepaterno',
                //         'users.fechanacimiento',
                //         'users.apematerno',
                //         'users.dni',
                //         'postulacion.id as idpostulacion',
                //         'area.nombre as area',
                //         'tarifa.descripcion as tarifa',
                //         'escuela.descripcion as escuela',
                //         'ambiente.descripcion as ambiente',
                //         'modalidad.descripcion as modalidad',
                //         'institucion_educativa.tipo as tipoie',
                //         'postulacion.resultado as resultado'
                //     )
                //     ->where('postulacion.estado', 2)
                //     ->where('escuela.id', $request->dato)
                //     ->where('postulacion.idproceso', $request->idproceso)
                //     ->get();

                $postulaciones = (DB::select(DB::raw("call  sp_calificar_escuela_proceso_2020_2($request->dato)")));

                break;
            default:


                //$postulaciones=(DB :: select( DB :: raw ("call sp_calificar_admision()")));
                $postulaciones = (DB::select(DB::raw("call sp_calificar_proceso_2020_2_canal_A()")));

                //$postulaciones=(DB :: select( DB :: raw ("call sp_calificar_canal()")));
                break;
        }
        return response()->json(['postulaciones' => $postulaciones]);
    }

    public function listPostulates2020II_canal_B(Request $request)
    {
        $postulacion = null;
        if ($request->dato == 0)
            $request->tipo = 0;
        switch ($request->tipo) {
            case 22: #Por Escuela
                // $postulaciones = Postulacion::join('users', 'postulacion.idPostulante', '=', 'users.id')
                //     ->join('escuela', 'postulacion.idescuela', '=', 'escuela.id')
                //     ->leftJoin('ambiente', 'postulacion.idambiente', '=', 'ambiente.id')
                //     ->join('tarifa', 'postulacion.idtarifa', '=', 'tarifa.id')
                //     ->join('modalidad', 'tarifa.idmodalidad', '=', 'modalidad.id')
                //     ->join('area', 'escuela.idarea', '=', 'area.id')
                //     ->select(
                //         'users.id as idpostulante',
                //         'users.nombre',
                //         'users.apepaterno',
                //         'users.fechanacimiento',
                //         'users.apematerno',
                //         'users.dni',
                //         'postulacion.id as idpostulacion',
                //         'area.nombre as area',
                //         'tarifa.descripcion as tarifa',
                //         'escuela.descripcion as escuela',
                //         'ambiente.descripcion as ambiente',
                //         'modalidad.descripcion as modalidad',
                //         'institucion_educativa.tipo as tipoie',
                //         'postulacion.resultado as resultado'
                //     )
                //     ->where('postulacion.estado', 2)
                //     ->where('escuela.id', $request->dato)
                //     ->where('postulacion.idproceso', $request->idproceso)
                //     ->get();

                $postulaciones = (DB::select(DB::raw("call  sp_calificar_escuela_proceso_2020_2($request->dato)")));

                break;
            default:


                //$postulaciones=(DB :: select( DB :: raw ("call sp_calificar_admision()")));
                $postulaciones = (DB::select(DB::raw("call sp_calificar_proceso_2020_2_canal_B()")));

                //$postulaciones=(DB :: select( DB :: raw ("call sp_calificar_canal()")));
                break;
        }
        return response()->json(['postulaciones' => $postulaciones]);
    }

    public function listPostulates2020II_canal_C(Request $request)
    {
        $postulacion = null;
        if ($request->dato == 0)
            $request->tipo = 0;
        switch ($request->tipo) {
            case 2: #Por Escuela
                // $postulaciones = Postulacion::join('users', 'postulacion.idPostulante', '=', 'users.id')
                //     ->join('escuela', 'postulacion.idescuela', '=', 'escuela.id')
                //     ->leftJoin('ambiente', 'postulacion.idambiente', '=', 'ambiente.id')
                //     ->join('tarifa', 'postulacion.idtarifa', '=', 'tarifa.id')
                //     ->join('modalidad', 'tarifa.idmodalidad', '=', 'modalidad.id')
                //     ->join('area', 'escuela.idarea', '=', 'area.id')
                //     ->select(
                //         'users.id as idpostulante',
                //         'users.nombre',
                //         'users.apepaterno',
                //         'users.fechanacimiento',
                //         'users.apematerno',
                //         'users.dni',
                //         'postulacion.id as idpostulacion',
                //         'area.nombre as area',
                //         'tarifa.descripcion as tarifa',
                //         'escuela.descripcion as escuela',
                //         'ambiente.descripcion as ambiente',
                //         'modalidad.descripcion as modalidad',
                //         'institucion_educativa.tipo as tipoie',
                //         'postulacion.resultado as resultado'
                //     )
                //     ->where('postulacion.estado', 2)
                //     ->where('escuela.id', $request->dato)
                //     ->where('postulacion.idproceso', $request->idproceso)
                //     ->get();

                $postulaciones = (DB::select(DB::raw("call  sp_calificar_escuela_proceso_2020_2($request->dato)")));

                break;
            default:


                //$postulaciones=(DB :: select( DB :: raw ("call sp_calificar_admision()")));
                $postulaciones = (DB::select(DB::raw("call sp_calificar_proceso_2020_2_canal_C()")));

                //$postulaciones=(DB :: select( DB :: raw ("call sp_calificar_canal()")));
                break;
        }
        return response()->json(['postulaciones' => $postulaciones]);
    }

    public function listPostulates2020II_canal_D(Request $request)
    {
        $postulacion = null;
        if ($request->dato == 0)
            $request->tipo = 0;
        switch ($request->tipo) {
            case 2: #Por Escuela
                // $postulaciones = Postulacion::join('users', 'postulacion.idPostulante', '=', 'users.id')
                //     ->join('escuela', 'postulacion.idescuela', '=', 'escuela.id')
                //     ->leftJoin('ambiente', 'postulacion.idambiente', '=', 'ambiente.id')
                //     ->join('tarifa', 'postulacion.idtarifa', '=', 'tarifa.id')
                //     ->join('modalidad', 'tarifa.idmodalidad', '=', 'modalidad.id')
                //     ->join('area', 'escuela.idarea', '=', 'area.id')
                //     ->select(
                //         'users.id as idpostulante',
                //         'users.nombre',
                //         'users.apepaterno',
                //         'users.fechanacimiento',
                //         'users.apematerno',
                //         'users.dni',
                //         'postulacion.id as idpostulacion',
                //         'area.nombre as area',
                //         'tarifa.descripcion as tarifa',
                //         'escuela.descripcion as escuela',
                //         'ambiente.descripcion as ambiente',
                //         'modalidad.descripcion as modalidad',
                //         'institucion_educativa.tipo as tipoie',
                //         'postulacion.resultado as resultado'
                //     )
                //     ->where('postulacion.estado', 2)
                //     ->where('escuela.id', $request->dato)
                //     ->where('postulacion.idproceso', $request->idproceso)
                //     ->get();

                $postulaciones = (DB::select(DB::raw("call  sp_calificar_escuela_proceso_2020_2($request->dato)")));

                break;
            default:


                //$postulaciones=(DB :: select( DB :: raw ("call sp_calificar_admision()")));
                $postulaciones = (DB::select(DB::raw("call sp_calificar_proceso_2020_2_canal_D()")));

                //$postulaciones=(DB :: select( DB :: raw ("call sp_calificar_canal()")));
                break;
        }
        return response()->json(['postulaciones' => $postulaciones]);
    }

    public function postulantesX()
    {
        $procesos = Proceso::orderBy('id', 'desc')->get();
        return view('calificacion')->with("procesos", $procesos);
    }

    public function listPostulatesX(Request $request)
    {
        $postulacion = null;
        if ($request->dato == 0)
            $request->tipo = 0;
        switch ($request->tipo) {
            case 1: #Por ambiente
                $postulaciones = Postulacion::join('users', 'postulacion.idPostulante', '=', 'users.id')
                    ->join('escuela', 'postulacion.idescuela', '=', 'escuela.id')
                    ->leftJoin('ambiente', 'postulacion.idambiente', '=', 'ambiente.id')
                    ->join('tarifa', 'postulacion.idtarifa', '=', 'tarifa.id')
                    ->join('modalidad', 'tarifa.idmodalidad', '=', 'modalidad.id')
                    ->leftJoin('institucion_educativa', 'users.idinstitucioneducativa', '=', 'institucion_educativa.id')
                    ->join('area', 'escuela.idarea', '=', 'area.id')
                    ->select(
                        'users.id as idpostulante',
                        'users.nombre',
                        'users.apepaterno',
                        'users.fechanacimiento',
                        'users.apematerno',
                        'users.dni',
                        'postulacion.id as idpostulacion',
                        'area.nombre as area',
                        'tarifa.descripcion as tarifa',
                        'escuela.descripcion as escuela',
                        'ambiente.descripcion as ambiente',
                        'modalidad.descripcion as modalidad',
                        'institucion_educativa.tipo as tipoie',
                        'postulacion.resultado as resultado'
                    )
                    ->where('postulacion.estado', 2)
                    ->where('ambiente.id', $request->dato)
                    ->where('postulacion.idproceso', $request->idproceso)
                    ->get();
                break;
            case 2: #Por Escuela
                $postulaciones = Postulacion::join('users', 'postulacion.idPostulante', '=', 'users.id')
                    ->join('escuela', 'postulacion.idescuela', '=', 'escuela.id')
                    ->leftJoin('ambiente', 'postulacion.idambiente', '=', 'ambiente.id')
                    ->join('tarifa', 'postulacion.idtarifa', '=', 'tarifa.id')
                    ->join('modalidad', 'tarifa.idmodalidad', '=', 'modalidad.id')
                    ->leftJoin('institucion_educativa', 'users.idinstitucioneducativa', '=', 'institucion_educativa.id')
                    ->join('area', 'escuela.idarea', '=', 'area.id')
                    ->select(
                        'users.id as idpostulante',
                        'users.nombre',
                        'users.apepaterno',
                        'users.fechanacimiento',
                        'users.apematerno',
                        'users.dni',
                        'postulacion.id as idpostulacion',
                        'area.nombre as area',
                        'tarifa.descripcion as tarifa',
                        'escuela.descripcion as escuela',
                        'ambiente.descripcion as ambiente',
                        'modalidad.descripcion as modalidad',
                        'institucion_educativa.tipo as tipoie',
                        'postulacion.resultado as resultado'
                    )
                    ->where('postulacion.estado', 2)
                    ->where('escuela.id', $request->dato)
                    ->where('postulacion.idproceso', $request->idproceso)
                    ->get();
                break;
            case 3: #Por modalidad
                $postulaciones = Postulacion::join('users', 'postulacion.idPostulante', '=', 'users.id')
                    ->join('escuela', 'postulacion.idescuela', '=', 'escuela.id')
                    ->leftJoin('ambiente', 'postulacion.idambiente', '=', 'ambiente.id')
                    ->join('tarifa', 'postulacion.idtarifa', '=', 'tarifa.id')
                    ->join('modalidad', 'tarifa.idmodalidad', '=', 'modalidad.id')
                    ->leftJoin('institucion_educativa', 'users.idinstitucioneducativa', '=', 'institucion_educativa.id')
                    ->join('area', 'escuela.idarea', '=', 'area.id')
                    ->select(
                        'users.id as idpostulante',
                        'users.nombre',
                        'users.apepaterno',
                        'users.fechanacimiento',
                        'users.apematerno',
                        'users.dni',
                        'postulacion.id as idpostulacion',
                        'area.nombre as area',
                        'tarifa.descripcion as tarifa',
                        'escuela.descripcion as escuela',
                        'ambiente.descripcion as ambiente',
                        'modalidad.descripcion as modalidad',
                        'institucion_educativa.tipo as tipoie',
                        'postulacion.resultado as resultado'
                    )
                    ->where('postulacion.estado', 2)
                    ->where('modalidad.id', $request->dato)
                    ->where('postulacion.idproceso', $request->idproceso)
                    ->get();
                break;
            case 4: #Por area
                $postulaciones = Postulacion::join('users', 'postulacion.idPostulante', '=', 'users.id')
                    ->join('escuela', 'postulacion.idescuela', '=', 'escuela.id')
                    ->leftJoin('ambiente', 'postulacion.idambiente', '=', 'ambiente.id')
                    ->join('tarifa', 'postulacion.idtarifa', '=', 'tarifa.id')
                    ->join('modalidad', 'tarifa.idmodalidad', '=', 'modalidad.id')
                    ->leftJoin('institucion_educativa', 'users.idinstitucioneducativa', '=', 'institucion_educativa.id')
                    ->join('area', 'escuela.idarea', '=', 'area.id')
                    ->select(
                        'users.id as idpostulante',
                        'users.nombre',
                        'users.apepaterno',
                        'users.fechanacimiento',
                        'users.apematerno',
                        'users.dni',
                        'postulacion.id as idpostulacion',
                        'area.nombre as area',
                        'tarifa.descripcion as tarifa',
                        'escuela.descripcion as escuela',
                        'ambiente.descripcion as ambiente',
                        'modalidad.descripcion as modalidad',
                        'institucion_educativa.tipo as tipoie',
                        'postulacion.resultado as resultado'
                    )
                    ->where('postulacion.estado', 2)
                    ->where('area.id', $request->dato)
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
                    ->select(
                        'users.id as idpostulante',
                        'users.nombre',
                        'users.apepaterno',
                        'users.fechanacimiento',
                        'users.apematerno',
                        'users.dni',
                        'postulacion.id as idpostulacion',
                        'area.nombre as area',
                        'tarifa.descripcion as tarifa',
                        'escuela.descripcion as escuela',
                        'ambiente.descripcion as ambiente',
                        'modalidad.descripcion as modalidad',
                        'institucion_educativa.tipo as tipoie',
                        'postulacion.resultado as resultado'
                    )
                    ->where('postulacion.estado', 2)
                    ->where('postulacion.idproceso', $request->idproceso)
                    ->get();
                break;
        }
        return response()->json(['postulaciones' => $postulaciones]);
    }

    public function cargarInformacionTXT(Request $request)
    {

        if (!Proceso::abierto())
            return "Acceso Denegado";
        $correcto = "SI";

        $proceso = (DB::select(DB::raw("CALL P_OBT_ADM_PROCESO(1)")));

        foreach ($proceso as $proceso) {
            $idProceso = $proceso->id;
            $descripcion = $proceso->descripcion;
        }

        $archivo = $request->file('archivo');
        $nombreOriginal = $archivo->getClientOriginalName();
        //AGREGO 17/11/2018
        $nombreOriginalProceso = $descripcion . $nombreOriginal;
        $extension = $archivo->getClientOriginalExtension();

        if ($extension == "dlm") {
            //$r = \Storage::disk('calificacion')->put($nombreOriginal, \File::get($archivo));
            $r = \Storage::disk('calificacion')->put($nombreOriginalProceso, \File::get($archivo));
        }

        //$ruta  =  storage_path('calificacion') ."/". $nombreOriginal;
        $ruta  =  storage_path('calificacion') . "/" . $nombreOriginalProceso;
        //$linecount = count(file(storage_path('calificacion') ."/". $nombreOriginal));
        $linecount = count(file(storage_path('calificacion') . "/" . $nombreOriginalProceso));

        $total = $linecount - 1;

        if (($handle = fopen($ruta, 'r')) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ',')) !== FALSE) {
                $litho = $data[0];
                $canal = $data[1];
                $codigo = $data[2];
                $codigoProceso = $idProceso;
                DB::statement("call P_INS_ADM_HOJA_IDENTIFICACION_ADMISION('$litho','$canal','$codigo',$codigoProceso)");
            }
            fclose($handle);
        }

        //CAMBIO 26/03/2019
        //$array=(DB :: select( "SELECT COUNT(LITHO) as TOTAL FROM hojaidenticacion"));   
        $array = (DB::select("SELECT COUNT(LITHO) as TOTAL FROM hojaidenticacion_proceso_3"));


        $total1 = 0;
        foreach ($array as $obj) {
            $total1 = $obj->TOTAL;
        }

        return response()->json(['correcto' => $correcto, 'total' => $total1, 'igual' => $litho]);
    }

    public function cargarInformacionTXT20202(Request $request)
    {

        if (!Proceso::abierto())
            return "Acceso Denegado";
        $correcto = "SI";

        $proceso = (DB::select(DB::raw("CALL P_OBT_ADM_PROCESO(1)")));

        foreach ($proceso as $proceso) {
            $idProceso = $proceso->id;
            $descripcion = $proceso->descripcion;
        }

        $archivo = $request->file('archivo');
        $nombreOriginal = $archivo->getClientOriginalName();
        //AGREGO 17/11/2018
        $nombreOriginalProceso = $descripcion . $nombreOriginal;
        $extension = $archivo->getClientOriginalExtension();

        if ($extension == "dlm") {
            //        	$r = \Storage::disk('calificacion')->put($nombreOriginal, \File::get($archivo));
            $r = \Storage::disk('calificacion')->put($nombreOriginalProceso, \File::get($archivo));
        }

        //        $ruta  =  storage_path('calificacion') ."/". $nombreOriginal;
        $ruta  =  storage_path('calificacion') . "/" . $nombreOriginalProceso;
        //       $linecount = count(file(storage_path('calificacion') ."/". $nombreOriginal));
        $linecount = count(file(storage_path('calificacion') . "/" . $nombreOriginalProceso));

        $total = $linecount - 1;

        if (($handle = fopen($ruta, 'r')) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ',')) !== FALSE) {
                $litho = $data[0];
                $canal = $data[1];
                $codigo = $data[2];
                $codigoProceso = $idProceso;
                DB::statement("call P_INS_ADM_HOJA_IDENTIFICACION_ADMISION_2020_2('$litho','$canal','$codigo',$codigoProceso)");
            }
            fclose($handle);
        }

        //CAMBIO 26/03/2019
        //$array=(DB :: select( "SELECT COUNT(LITHO) as TOTAL FROM hojaidenticacion"));   
        $array = (DB::select("SELECT COUNT(LITHO) as TOTAL FROM hojaidenticacion_proceso_2020_2"));


        $total1 = 0;
        foreach ($array as $obj) {
            $total1 = $obj->TOTAL;
        }

        return response()->json(['correcto' => $correcto, 'total' => $total1, 'igual' => $litho]);
    }

    public function cargarInformacionTXT20202E(Request $request)
    {

        if (!Proceso::abierto())
            return "Acceso Denegado";
        $correcto = "SI";

        $proceso = (DB::select(DB::raw("CALL P_OBT_ADM_PROCESO(1)")));

        foreach ($proceso as $proceso) {
            $idProceso = $proceso->id;
            $descripcion = $proceso->descripcion;
        }

        $archivo = $request->file('archivo');
        $nombreOriginal = $archivo->getClientOriginalName();
        //AGREGO 17/11/2018
        $nombreOriginalProceso = $descripcion . $nombreOriginal;
        $extension = $archivo->getClientOriginalExtension();

        if ($extension == "dlm") {
            //        	$r = \Storage::disk('calificacion')->put($nombreOriginal, \File::get($archivo));
            $r = \Storage::disk('calificacion')->put($nombreOriginalProceso, \File::get($archivo));
        }

        //        $ruta  =  storage_path('calificacion') ."/". $nombreOriginal;
        $ruta  =  storage_path('calificacion') . "/" . $nombreOriginalProceso;
        //       $linecount = count(file(storage_path('calificacion') ."/". $nombreOriginal));
        $linecount = count(file(storage_path('calificacion') . "/" . $nombreOriginalProceso));

        $total = $linecount - 1;

        if (($handle = fopen($ruta, 'r')) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ',')) !== FALSE) {
                $litho = $data[0];
                $canal = $data[1];
                $codigo = $data[2];
                $codigoProceso = $idProceso;
                DB::statement("call P_INS_ADM_HOJA_IDENTIFICACION_ADMISION_2020_2_E('$litho','$canal','$codigo',$codigoProceso)");
            }
            fclose($handle);
        }

        //CAMBIO 26/03/2019
        //$array=(DB :: select( "SELECT COUNT(LITHO) as TOTAL FROM hojaidenticacion"));   
        // $array = (DB::select("SELECT COUNT(LITHO) as TOTAL FROM hojaidenticacion_proceso_2020_2_esp"));

       // $total1 = 0;
       // foreach ($array as $obj) {
        //   $total1 = $obj->TOTAL;
        // }

        return response()->json(['correcto' => $correcto, 'igual' => $litho]);
    }


    public function cargarInformacionTXT1(Request $request)
    {

        /*if(!Proceso::abierto())
            return "Acceso Denegado";
        $correcto="SI";
        
        //AGREGO 11/10/2018
        $proceso = DB::table('proceso')
                    ->select('id','descripcion')
                    ->where('activo',1)
                    ->get();

        $array = json_decode($proceso); 
        $idProceso="" ;
        $descripcion="";
        foreach($array as $obj){
            $idProceso= $obj->id;
            $descripcion= $obj->descripcion;
        }
        
        $archivo2 =$request->file('archivo2');
        $nombreOriginal2= $archivo2->getClientOriginalName();
        //AGREGO 11/10/2018
        $nombreOriginalProceso = $descripcion.$nombreOriginal2;
        $extension2 = $archivo2->getClientOriginalExtension();
        
        if($extension2=="dlm"){
        //AGREGO 11/10/2018
                //$r2 = \Storage::disk('calificacion')->put($nombreOriginal2, \File::get($archivo2));  
                $r2 = \Storage::disk('calificacion')->put($nombreOriginalProceso , \File::get($archivo2));  
        }
        

       //$linecount = count(file(storage_path('calificacion') ."/". $nombreOriginal2));
              $linecount = count(file(storage_path('calificacion') ."/". $nombreOriginalProceso ));
       
       $total = $linecount-1;
        
        //        $ruta  =  storage_path('calificacion') ."/". $nombreOriginal2;
                $ruta  =  storage_path('calificacion') ."/". $nombreOriginalProceso ;
        $fila = 1;
        if(($handle = fopen($ruta,'r'))!==FALSE){
        	        		
        		while(($data=fgetcsv($handle, 1000, ','))!==FALSE){

			$numero = count($data);

			$fila++;
			
			for ($c=2; $c < $numero; $c++) {
			    
        		     $hojarespuesta= new Hojarespuesta();
        		     $hojarespuesta->LITHO=$data[0];
	        		$hojarespuesta->CANAL=$data[1];
				$hojarespuesta->ID=$c-1;
	        		$hojarespuesta->R=$data[$c];    
	        		$hojarespuesta->idProceso=$idProceso;    		
	        		$hojarespuesta->save();         		
		        }
			        	
        	}	        	
        	fclose($handle);
        
            }

        	 return response()->json(['correcto' => $correcto,'total' => $total ]);*/
        if (!Proceso::abierto())
            return "Acceso Denegado";
        $correcto = "SI";

        $proceso = (DB::select(DB::raw("CALL P_OBT_ADM_PROCESO(1)")));

        foreach ($proceso as $proceso) {
            $idProceso = $proceso->id;
            $descripcion = $proceso->descripcion;
        }

        $archivo = $request->file('archivo2');
        $nombreOriginal = $archivo->getClientOriginalName();
        $nombreOriginalProceso = $descripcion . "-" . $nombreOriginal;
        $extension = $archivo->getClientOriginalExtension();

        if ($extension == "dlm") {
            $r = \Storage::disk('calificacion')->put($nombreOriginalProceso, \File::get($archivo));
        }

        $USUARIO = Auth::id();

        $ruta  =  storage_path('calificacion') . "/" . $nombreOriginalProceso;

        $fila = 1;

        if (($handle = fopen($ruta, 'r')) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ',')) !== FALSE) {
                $numero = count($data);
                $fila++;
                for ($c = 2; $c < $numero; $c++) {
                    $litho = $data[0];
                    $canal = $data[1];
                    $clavemarcada = $data[$c];
                    $nropregunta = $c - 1;
                    $codigoProceso = $idProceso;
                    DB::statement("call P_INS_ADM_HOJA_RESPUESTA_ADMISION('$litho','$canal','$nropregunta','$clavemarcada',$codigoProceso)");
                }
            }
            fclose($handle);
        }

        /*$array=(DB :: select( "CALL P_OBT_ADM_CANTIDAD_LITHO_RESPUESTA($idProceso)"));   

        $id_fruta=0;
        foreach($array as $obj){
            $id_fruta = $obj->TOTAL;
        }
        $total=$id_fruta-2;*/
        //return response()->json(['correcto' => $correcto, 'total' =>  $total]);
        //$total=0;
        //return response()->json(['correcto' => $correcto,'total' => $total ]);
        return response()->json(['correcto' => $correcto]);
    }

    public function cargarInformacionTXT120202(Request $request)
    {

        /*if(!Proceso::abierto())
            return "Acceso Denegado";
        $correcto="SI";
        
        //AGREGO 11/10/2018
        $proceso = DB::table('proceso')
                    ->select('id','descripcion')
                    ->where('activo',1)
                    ->get();

        $array = json_decode($proceso); 
        $idProceso="" ;
        $descripcion="";
        foreach($array as $obj){
            $idProceso= $obj->id;
            $descripcion= $obj->descripcion;
        }
        
        $archivo2 =$request->file('archivo2');
        $nombreOriginal2= $archivo2->getClientOriginalName();
        //AGREGO 11/10/2018
        $nombreOriginalProceso = $descripcion.$nombreOriginal2;
        $extension2 = $archivo2->getClientOriginalExtension();
        
        if($extension2=="dlm"){
        //AGREGO 11/10/2018
                //$r2 = \Storage::disk('calificacion')->put($nombreOriginal2, \File::get($archivo2));  
                $r2 = \Storage::disk('calificacion')->put($nombreOriginalProceso , \File::get($archivo2));  
        }
        

       //$linecount = count(file(storage_path('calificacion') ."/". $nombreOriginal2));
              $linecount = count(file(storage_path('calificacion') ."/". $nombreOriginalProceso ));
       
       $total = $linecount-1;
        
        //        $ruta  =  storage_path('calificacion') ."/". $nombreOriginal2;
                $ruta  =  storage_path('calificacion') ."/". $nombreOriginalProceso ;
        $fila = 1;
        if(($handle = fopen($ruta,'r'))!==FALSE){
        	        		
        		while(($data=fgetcsv($handle, 1000, ','))!==FALSE){

			$numero = count($data);

			$fila++;
			
			for ($c=2; $c < $numero; $c++) {
			    
        		     $hojarespuesta= new Hojarespuesta();
        		     $hojarespuesta->LITHO=$data[0];
	        		$hojarespuesta->CANAL=$data[1];
				$hojarespuesta->ID=$c-1;
	        		$hojarespuesta->R=$data[$c];    
	        		$hojarespuesta->idProceso=$idProceso;    		
	        		$hojarespuesta->save();         		
		        }
			        	
        	}	        	
        	fclose($handle);
        
            }

        	 return response()->json(['correcto' => $correcto,'total' => $total ]);*/
        if (!Proceso::abierto())
            return "Acceso Denegado";
        $correcto = "SI";

        $proceso = (DB::select(DB::raw("CALL P_OBT_ADM_PROCESO(1)")));

        foreach ($proceso as $proceso) {
            $idProceso = $proceso->id;
            $descripcion = $proceso->descripcion;
        }

        $archivo = $request->file('archivo2');
        $nombreOriginal = $archivo->getClientOriginalName();
        $nombreOriginalProceso = $descripcion . "-" . $nombreOriginal;
        $extension = $archivo->getClientOriginalExtension();

        if ($extension == "dlm") {
            $r = \Storage::disk('calificacion')->put($nombreOriginalProceso, \File::get($archivo));
        }

        $USUARIO = Auth::id();

        $ruta  =  storage_path('calificacion') . "/" . $nombreOriginalProceso;

        $fila = 1;

        if (($handle = fopen($ruta, 'r')) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ',')) !== FALSE) {
                $numero = count($data);
                $fila++;
                for ($c = 2; $c < $numero; $c++) {
                    $litho = $data[0];
                    $canal = $data[1];
                    $clavemarcada = $data[$c];
                    $nropregunta = $c - 1;
                    $codigoProceso = $idProceso;
                    DB::statement("call P_INS_ADM_HOJA_RESPUESTA_ADMISION_2020_2('$litho','$canal','$nropregunta','$clavemarcada',$codigoProceso)");
                }
            }
            fclose($handle);
        }

        /*$array=(DB :: select( "CALL P_OBT_ADM_CANTIDAD_LITHO_RESPUESTA($idProceso)"));   

        $id_fruta=0;
        foreach($array as $obj){
            $id_fruta = $obj->TOTAL;
        }
        $total=$id_fruta-2;*/
        //return response()->json(['correcto' => $correcto, 'total' =>  $total]);
        //$total=0;
        //return response()->json(['correcto' => $correcto,'total' => $total ]);
        return response()->json(['correcto' => $correcto]);
    }

    public function cargarInformacionTXT120202E(Request $request)
    {

        /*if(!Proceso::abierto())
            return "Acceso Denegado";
        $correcto="SI";
        
        //AGREGO 11/10/2018
        $proceso = DB::table('proceso')
                    ->select('id','descripcion')
                    ->where('activo',1)
                    ->get();

        $array = json_decode($proceso); 
        $idProceso="" ;
        $descripcion="";
        foreach($array as $obj){
            $idProceso= $obj->id;
            $descripcion= $obj->descripcion;
        }
        
        $archivo2 =$request->file('archivo2');
        $nombreOriginal2= $archivo2->getClientOriginalName();
        //AGREGO 11/10/2018
        $nombreOriginalProceso = $descripcion.$nombreOriginal2;
        $extension2 = $archivo2->getClientOriginalExtension();
        
        if($extension2=="dlm"){
        //AGREGO 11/10/2018
                //$r2 = \Storage::disk('calificacion')->put($nombreOriginal2, \File::get($archivo2));  
                $r2 = \Storage::disk('calificacion')->put($nombreOriginalProceso , \File::get($archivo2));  
        }
        

       //$linecount = count(file(storage_path('calificacion') ."/". $nombreOriginal2));
              $linecount = count(file(storage_path('calificacion') ."/". $nombreOriginalProceso ));
       
       $total = $linecount-1;
        
        //        $ruta  =  storage_path('calificacion') ."/". $nombreOriginal2;
                $ruta  =  storage_path('calificacion') ."/". $nombreOriginalProceso ;
        $fila = 1;
        if(($handle = fopen($ruta,'r'))!==FALSE){
        	        		
        		while(($data=fgetcsv($handle, 1000, ','))!==FALSE){

			$numero = count($data);

			$fila++;
			
			for ($c=2; $c < $numero; $c++) {
			    
        		     $hojarespuesta= new Hojarespuesta();
        		     $hojarespuesta->LITHO=$data[0];
	        		$hojarespuesta->CANAL=$data[1];
				$hojarespuesta->ID=$c-1;
	        		$hojarespuesta->R=$data[$c];    
	        		$hojarespuesta->idProceso=$idProceso;    		
	        		$hojarespuesta->save();         		
		        }
			        	
        	}	        	
        	fclose($handle);
        
            }

        	 return response()->json(['correcto' => $correcto,'total' => $total ]);*/
        if (!Proceso::abierto())
            return "Acceso Denegado";
        $correcto = "SI";

        $proceso = (DB::select(DB::raw("CALL P_OBT_ADM_PROCESO(1)")));

        foreach ($proceso as $proceso) {
            $idProceso = $proceso->id;
            $descripcion = $proceso->descripcion;
        }

        $archivo = $request->file('archivo2');
        $nombreOriginal = $archivo->getClientOriginalName();
        $nombreOriginalProceso = $descripcion . "-" . $nombreOriginal;
        $extension = $archivo->getClientOriginalExtension();

        if ($extension == "dlm") {
            $r = \Storage::disk('calificacion')->put($nombreOriginalProceso, \File::get($archivo));
        }

        $USUARIO = Auth::id();

        $ruta  =  storage_path('calificacion') . "/" . $nombreOriginalProceso;

        $fila = 1;

        if (($handle = fopen($ruta, 'r')) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ',')) !== FALSE) {
                $numero = count($data);
                $fila++;
                for ($c = 2; $c < $numero; $c++) {
                    $litho = $data[0];
                    $canal = $data[1];
                    $clavemarcada = $data[$c];
                    $nropregunta = $c - 1;
                    $codigoProceso = $idProceso;
                    DB::statement("call P_INS_ADM_HOJA_RESPUESTA_ADMISION_2020_2_E('$litho','$canal','$nropregunta','$clavemarcada',$codigoProceso)");
                }
            }
            fclose($handle);
        }

        /*$array=(DB :: select( "CALL P_OBT_ADM_CANTIDAD_LITHO_RESPUESTA($idProceso)"));   

        $id_fruta=0;
        foreach($array as $obj){
            $id_fruta = $obj->TOTAL;
        }
        $total=$id_fruta-2;*/
        //return response()->json(['correcto' => $correcto, 'total' =>  $total]);
        //$total=0;
        //return response()->json(['correcto' => $correcto,'total' => $total ]);
        return response()->json(['correcto' => $correcto]);
    }

    public function cargarInformacionTXT2(Request $request)
    {

        /*if(!Proceso::abierto())
            return "Acceso Denegado";
        $correcto="SI";
        
        
        //AGREGO 17/11/2018
        $proceso = DB::table('proceso')
                    ->select('id','descripcion')
                    ->where('activo',1)
                    ->get();

        $array = json_decode($proceso); 
        $idProceso="" ;
        $descripcion="";
        foreach($array as $obj){
            $idProceso= $obj->id;
            $descripcion= $obj->descripcion;
        }
        
       $archivo3 =$request->file('archivo3');
        $nombreOriginal3= $archivo3->getClientOriginalName();
        //AGREGO 17/11/2018
        $nombreOriginalProceso3 = $descripcion.$nombreOriginal3;
        $extension3 = $archivo3->getClientOriginalExtension();
        
        if($extension3=="dlm"){
        //MODIFICADO 17/11/2018
	    //$r3 = \Storage::disk('calificacion')->put($nombreOriginal3, \File::get($archivo3));  
                $r3 = \Storage::disk('calificacion')->put($nombreOriginalProceso3 , \File::get($archivo3));   
        }
        
        //MODIFICADO 17/11/2018
       //$ruta2  =  storage_path('calificacion') ."/". $nombreOriginal3;
       $ruta2  =  storage_path('calificacion') ."/". $nombreOriginalProceso3;
        
        if(($handle = fopen($ruta2,'r'))!==FALSE){
        	while(($data1=fgetcsv($handle, 1000, ','))!==FALSE){	        	
		        
		        $numero = count($data1);
		        for ($c=2; $c < $numero; $c++) {
		        $hojaclaves = new Hojaclaves();
        		$hojaclaves ->LITHO=$data1[0];        		
        		$hojaclaves ->CANAL=$data1[1];
        		$hojaclaves ->idpregunta=$c-1;
        		$hojaclaves ->R=$data1[$c];
        		$hojaclaves ->idProceso=$idProceso;
        		$hojaclaves ->save();
		        }
        		
        	}
        	fclose($handle);
        }*/

        if (!Proceso::abierto())
            return "Acceso Denegado";
        $correcto = "SI";

        $proceso = (DB::select(DB::raw("CALL P_OBT_ADM_PROCESO(1)")));

        foreach ($proceso as $proceso) {
            $idProceso = $proceso->id;
            $descripcion = $proceso->descripcion;
        }

        $archivo3 = $request->file('archivo3');
        $nombreOriginal = $archivo3->getClientOriginalName();
        $nombreOriginalProceso = $descripcion . "-" . $nombreOriginal;
        $extension = $archivo3->getClientOriginalExtension();

        if ($extension == "dlm") {
            $r = \Storage::disk('calificacion')->put($nombreOriginalProceso, \File::get($archivo3));
        }

        $USUARIO = Auth::id();

        $ruta  =  storage_path('calificacion') . "/" . $nombreOriginalProceso;

        $fila = 1;

        if (($handle = fopen($ruta, 'r')) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ',')) !== FALSE) {
                $numero = count($data);
                $fila++;
                for ($c = 2; $c < $numero; $c++) {
                    $litho = $data[0];
                    $canal = $data[1];
                    $clavemarcada = $data[$c];
                    $nropregunta = $c - 1;
                    $codigoProceso = $idProceso;
                    DB::statement("call P_INS_ADM_HOJA_CLAVES_ADMISION('$litho','$canal','$nropregunta','$clavemarcada',$codigoProceso)");
                }
            }
            fclose($handle);
        }

        return response()->json(['correcto' => $correcto]);
    }

    public function cargarInformacionTXT220202(Request $request)
    {

        /*if(!Proceso::abierto())
            return "Acceso Denegado";
        $correcto="SI";
        
        
        //AGREGO 17/11/2018
        $proceso = DB::table('proceso')
                    ->select('id','descripcion')
                    ->where('activo',1)
                    ->get();

        $array = json_decode($proceso); 
        $idProceso="" ;
        $descripcion="";
        foreach($array as $obj){
            $idProceso= $obj->id;
            $descripcion= $obj->descripcion;
        }
        
       $archivo3 =$request->file('archivo3');
        $nombreOriginal3= $archivo3->getClientOriginalName();
        //AGREGO 17/11/2018
        $nombreOriginalProceso3 = $descripcion.$nombreOriginal3;
        $extension3 = $archivo3->getClientOriginalExtension();
        
        if($extension3=="dlm"){
        //MODIFICADO 17/11/2018
	    //$r3 = \Storage::disk('calificacion')->put($nombreOriginal3, \File::get($archivo3));  
                $r3 = \Storage::disk('calificacion')->put($nombreOriginalProceso3 , \File::get($archivo3));   
        }
        
        //MODIFICADO 17/11/2018
       //$ruta2  =  storage_path('calificacion') ."/". $nombreOriginal3;
       $ruta2  =  storage_path('calificacion') ."/". $nombreOriginalProceso3;
        
        if(($handle = fopen($ruta2,'r'))!==FALSE){
        	while(($data1=fgetcsv($handle, 1000, ','))!==FALSE){	        	
		        
		        $numero = count($data1);
		        for ($c=2; $c < $numero; $c++) {
		        $hojaclaves = new Hojaclaves();
        		$hojaclaves ->LITHO=$data1[0];        		
        		$hojaclaves ->CANAL=$data1[1];
        		$hojaclaves ->idpregunta=$c-1;
        		$hojaclaves ->R=$data1[$c];
        		$hojaclaves ->idProceso=$idProceso;
        		$hojaclaves ->save();
		        }
        		
        	}
        	fclose($handle);
        }*/

        if (!Proceso::abierto())
            return "Acceso Denegado";
        $correcto = "SI";

        $proceso = (DB::select(DB::raw("CALL P_OBT_ADM_PROCESO(1)")));

        foreach ($proceso as $proceso) {
            $idProceso = $proceso->id;
            $descripcion = $proceso->descripcion;
        }

        $archivo3 = $request->file('archivo3');
        $nombreOriginal = $archivo3->getClientOriginalName();
        $nombreOriginalProceso = $descripcion . "-" . $nombreOriginal;
        $extension = $archivo3->getClientOriginalExtension();

        if ($extension == "dlm") {
            $r = \Storage::disk('calificacion')->put($nombreOriginalProceso, \File::get($archivo3));
        }

        $USUARIO = Auth::id();

        $ruta  =  storage_path('calificacion') . "/" . $nombreOriginalProceso;

        $fila = 1;

        if (($handle = fopen($ruta, 'r')) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ',')) !== FALSE) {
                $numero = count($data);
                $fila++;
                for ($c = 2; $c < $numero; $c++) {
                    $litho = $data[0];
                    $canal = $data[1];
                    $clavemarcada = $data[$c];
                    $nropregunta = $c - 1;
                    $codigoProceso = $idProceso;
                    DB::statement("call P_INS_ADM_HOJA_CLAVES_ADMISION_2020_2('$litho','$canal','$nropregunta','$clavemarcada',$codigoProceso)");
                }
            }
            fclose($handle);
        }

        return response()->json(['correcto' => $correcto]);
    }

    public function cargarInformacionTXT220202E(Request $request)
    {

        /*if(!Proceso::abierto())
            return "Acceso Denegado";
        $correcto="SI";
        
        
        //AGREGO 17/11/2018
        $proceso = DB::table('proceso')
                    ->select('id','descripcion')
                    ->where('activo',1)
                    ->get();

        $array = json_decode($proceso); 
        $idProceso="" ;
        $descripcion="";
        foreach($array as $obj){
            $idProceso= $obj->id;
            $descripcion= $obj->descripcion;
        }
        
       $archivo3 =$request->file('archivo3');
        $nombreOriginal3= $archivo3->getClientOriginalName();
        //AGREGO 17/11/2018
        $nombreOriginalProceso3 = $descripcion.$nombreOriginal3;
        $extension3 = $archivo3->getClientOriginalExtension();
        
        if($extension3=="dlm"){
        //MODIFICADO 17/11/2018
	    //$r3 = \Storage::disk('calificacion')->put($nombreOriginal3, \File::get($archivo3));  
                $r3 = \Storage::disk('calificacion')->put($nombreOriginalProceso3 , \File::get($archivo3));   
        }
        
        //MODIFICADO 17/11/2018
       //$ruta2  =  storage_path('calificacion') ."/". $nombreOriginal3;
       $ruta2  =  storage_path('calificacion') ."/". $nombreOriginalProceso3;
        
        if(($handle = fopen($ruta2,'r'))!==FALSE){
        	while(($data1=fgetcsv($handle, 1000, ','))!==FALSE){	        	
		        
		        $numero = count($data1);
		        for ($c=2; $c < $numero; $c++) {
		        $hojaclaves = new Hojaclaves();
        		$hojaclaves ->LITHO=$data1[0];        		
        		$hojaclaves ->CANAL=$data1[1];
        		$hojaclaves ->idpregunta=$c-1;
        		$hojaclaves ->R=$data1[$c];
        		$hojaclaves ->idProceso=$idProceso;
        		$hojaclaves ->save();
		        }
        		
        	}
        	fclose($handle);
        }*/

        if (!Proceso::abierto())
            return "Acceso Denegado";
        $correcto = "SI";

        $proceso = (DB::select(DB::raw("CALL P_OBT_ADM_PROCESO(1)")));

        foreach ($proceso as $proceso) {
            $idProceso = $proceso->id;
            $descripcion = $proceso->descripcion;
        }

        $archivo3 = $request->file('archivo3');
        $nombreOriginal = $archivo3->getClientOriginalName();
        $nombreOriginalProceso = $descripcion . "-" . $nombreOriginal;
        $extension = $archivo3->getClientOriginalExtension();

        if ($extension == "dlm") {
            $r = \Storage::disk('calificacion')->put($nombreOriginalProceso, \File::get($archivo3));
        }

        $USUARIO = Auth::id();

        $ruta  =  storage_path('calificacion') . "/" . $nombreOriginalProceso;

        $fila = 1;

        if (($handle = fopen($ruta, 'r')) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ',')) !== FALSE) {
                $numero = count($data);
                $fila++;
                for ($c = 2; $c < $numero; $c++) {
                    $litho = $data[0];
                    $canal = $data[1];
                    $clavemarcada = $data[$c];
                    $nropregunta = $c - 1;
                    $codigoProceso = $idProceso;
                    DB::statement("call P_INS_ADM_HOJA_CLAVES_ADMISION_2020_2_E('$litho','$canal','$nropregunta','$clavemarcada',$codigoProceso)");
                }
            }
            fclose($handle);
        }

        return response()->json(['correcto' => $correcto]);
    }

    public function cargarInformacionTXT3(Request $request)
    {

        if (!Proceso::abierto())
            return "Acceso Denegado";
        $correcto = "SI";
        $archivo4 = $request->file('archivo4');
        $nombreOriginal4 = $archivo4->getClientOriginalName();
        $extension4 = $archivo4->getClientOriginalExtension();

        if ($extension4 == "dlm") {
            $r4 = \Storage::disk('calificacion')->put($nombreOriginal4, \File::get($archivo4));
        }

        $ruta3  =  storage_path('calificacion') . "/" . $nombreOriginal4;

        if (($handle = fopen($ruta3, 'r')) !== FALSE) {
            while (($data2 = fgetcsv($handle, 1000, ',')) !== FALSE) {

                $numero = count($data2);
                for ($c = 2; $c < $numero; $c++) {
                    $hojaclaves = new Hojaclaves();
                    $hojaclaves->LITHO = $data2[0];
                    $hojaclaves->CANAL = $data2[1];
                    $hojaclaves->idpregunta = $c - 1;
                    $hojaclaves->R = $data2[$c];
                    $hojaclaves->save();
                }
            }
            fclose($handle);
        }

        return response()->json(['correcto' => $correcto]);
    }

    public function cargarInformacionTXT320202(Request $request)
    {

        if (!Proceso::abierto())
            return "Acceso Denegado";
        $correcto = "SI";
        $archivo4 = $request->file('archivo4');
        $nombreOriginal4 = $archivo4->getClientOriginalName();
        $extension4 = $archivo4->getClientOriginalExtension();

        if ($extension4 == "dlm") {
            $r4 = \Storage::disk('calificacion')->put($nombreOriginal4, \File::get($archivo4));
        }

        $ruta3  =  storage_path('calificacion') . "/" . $nombreOriginal4;

        if (($handle = fopen($ruta3, 'r')) !== FALSE) {
            while (($data2 = fgetcsv($handle, 1000, ',')) !== FALSE) {

                $numero = count($data2);
                for ($c = 2; $c < $numero; $c++) {
                    $hojaclaves = new Hojaclaves();
                    $hojaclaves->LITHO = $data2[0];
                    $hojaclaves->CANAL = $data2[1];
                    $hojaclaves->idpregunta = $c - 1;
                    $hojaclaves->R = $data2[$c];
                    $hojaclaves->save();
                }
            }
            fclose($handle);
        }

        return response()->json(['correcto' => $correcto]);
    }

    public function cargarInformacionTXT320202E(Request $request)
    {

        if (!Proceso::abierto())
            return "Acceso Denegado";
        $correcto = "SI";
        $archivo4 = $request->file('archivo4');
        $nombreOriginal4 = $archivo4->getClientOriginalName();
        $extension4 = $archivo4->getClientOriginalExtension();

        if ($extension4 == "dlm") {
            $r4 = \Storage::disk('calificacion')->put($nombreOriginal4, \File::get($archivo4));
        }

        $ruta3  =  storage_path('calificacion') . "/" . $nombreOriginal4;

        if (($handle = fopen($ruta3, 'r')) !== FALSE) {
            while (($data2 = fgetcsv($handle, 1000, ',')) !== FALSE) {

                $numero = count($data2);
                for ($c = 2; $c < $numero; $c++) {
                    $hojaclaves = new Hojaclaves();
                    $hojaclaves->LITHO = $data2[0];
                    $hojaclaves->CANAL = $data2[1];

                    $hojaclaves->idpregunta = $c - 1;
                    $hojaclaves->R = $data2[$c];
                    $hojaclaves->save();
                }
            }
            fclose($handle);
        }

        return response()->json(['correcto' => $correcto]);
    }

    public function cargarInformacionTXTCepre(Request $request)
    {

        if (!Proceso::abierto())
            return "Acceso Denegado";

        //AGREGO 24/09/2018
        $proceso = DB::table('proceso')
            ->select('id', 'descripcion')
            ->where('activo', 1)
            ->get();

        $array = json_decode($proceso);
        $idProceso = "";
        $descripcion = "";
        foreach ($array as $obj) {
            $idProceso = $obj->id;
            $descripcion = $obj->descripcion;
        }

        $correcto = "SI";
        $archivo = $request->file('archivo');
        $nombreOriginal = $archivo->getClientOriginalName();
        //AGREGO 25/09/2018
        $nombreOriginalProceso = $descripcion . $nombreOriginal;

        $extension = $archivo->getClientOriginalExtension();

        if ($extension == "dlm") {
            //MODIFICO 24/09/2018
            //$r = \Storage::disk('calificacioncepre')->put($nombreOriginal, \File::get($archivo));        
            $r = \Storage::disk('calificacioncepre')->put($nombreOriginalProceso, \File::get($archivo));
        }

        //MODIFICO 25/09/2018
        //$ruta  =  storage_path('calificacioncepre') ."/". $nombreOriginal;        
        $ruta  =  storage_path('calificacioncepre') . "/" . $nombreOriginalProceso;
        //AGREGO 24/09/2018 $hojaidentificacioncepre ->idProceso=$idProceso;

        $fila = 0;
        if (($handle = fopen($ruta, 'r')) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ',')) !== FALSE) {

                $hojaidentificacioncepre = new Hojaidentificacioncepre();
                if ($data[0] == 'LITHO') {
                } else {
                    $hojaidentificacioncepre->LITHO = $data[0];
                    $hojaidentificacioncepre->CANAL = $data[1];
                    $hojaidentificacioncepre->CODIGO = $data[2];
                    $hojaidentificacioncepre->AULA = $nombreOriginal;
                    $hojaidentificacioncepre->idProceso = $idProceso;
                    $hojaidentificacioncepre->save();
                    $fila++;
                    $numero = $fila;
                    $total = $numero;
                }
            }
            fclose($handle);
        }



        //        $ruta1  =  storage_path('calificacion') ."/". 'hojarespuestaX.dlm';

        return response()->json(['correcto' => $correcto, 'total' => $total]);
    }

    public function cargarInformacionTXTCepre1(Request $request)
    {

        if (!Proceso::abierto())
            return "Acceso Denegado";
        $correcto = "SI";

        //AGREGO 24/09/2018
        $proceso = DB::table('proceso')
            ->select('id', 'descripcion')
            ->where('activo', 1)
            ->get();

        $array = json_decode($proceso);
        $idProceso = "";
        $descripcion = "";
        foreach ($array as $obj) {
            $idProceso = $obj->id;
            $descripcion = $obj->descripcion;
        }

        $archivo2 = $request->file('archivo2');
        $nombreOriginal2 = $archivo2->getClientOriginalName();

        //AGREGO 24/09/2018
        $nombreOriginalProceso = $descripcion . $nombreOriginal2;

        $extension2 = $archivo2->getClientOriginalExtension();

        if ($extension2 == "dlm") {
            //MODIFICO 25/09/2018
            //$r2 = \Storage::disk('calificacioncepre')->put($nombreOriginal2, \File::get($archivo2));  
            $r2 = \Storage::disk('calificacioncepre')->put($nombreOriginalProceso, \File::get($archivo2));
        }

        //MODIFICO 25/09/2018
        //$ruta  =  storage_path('calificacioncepre') ."/". $nombreOriginal2;
        $ruta  =  storage_path('calificacioncepre') . "/" . $nombreOriginalProceso;


        $fila = 1;
        if (($handle = fopen($ruta, 'r')) !== FALSE) {

            while (($data = fgetcsv($handle, 1000, ',')) !== FALSE) {

                $numero = count($data);

                $fila++;

                for ($c = 2; $c < $numero; $c++) {
                    $hojarespuesta = new Hojarespuestacepre();
                    $hojarespuesta->LITHO = $data[0];
                    $hojarespuesta->CANAL = $data[1];
                    $hojarespuesta->ID = $c - 1;
                    $hojarespuesta->R = $data[$c];
                    $hojarespuesta->idProceso = $idProceso;
                    $hojarespuesta->save();
                }
            }
            fclose($handle);
        }


        //        $ruta1  =  storage_path('calificacion') ."/". 'hojarespuestaX.dlm';

        return response()->json(['correcto' => $correcto]);
    }

    public function cargarInformacionTXTCepre2(Request $request)
    {

        if (!Proceso::abierto())
            return "Acceso Denegado";
        $correcto = "SI";

        //AGREGO 24/09/2018
        $proceso = DB::table('proceso')
            ->select('id', 'descripcion')
            ->where('activo', 1)
            ->get();

        $array = json_decode($proceso);
        $idProceso = "";
        $descripcion = "";
        foreach ($array as $obj) {
            $idProceso = $obj->id;
            $descripcion = $obj->descripcion;
        }

        $archivo3 = $request->file('archivo3');
        $nombreOriginal3 = $archivo3->getClientOriginalName();
        //AGREGO 24/09/2018
        $nombreOriginalProceso3 = $descripcion . $nombreOriginal3;

        $extension3 = $archivo3->getClientOriginalExtension();

        if ($extension3 == "dlm") {
            //MODIFICO 24/09/2018	
            //$r3 = \Storage::disk('calificacioncepre')->put($nombreOriginal3, \File::get($archivo3));  
            $r3 = \Storage::disk('calificacioncepre')->put($nombreOriginalProceso3, \File::get($archivo3));
        }

        //MODIFICADO 25/09/2018
        //$ruta2  =  storage_path('calificacioncepre') ."/". $nombreOriginal3;
        $ruta2  =  storage_path('calificacioncepre') . "/" . $nombreOriginalProceso3;

        //AGREGO 24/09/2018 $hojaclavescepre ->idProceso=$idProceso;

        if (($handle = fopen($ruta2, 'r')) !== FALSE) {
            while (($data1 = fgetcsv($handle, 1000, ',')) !== FALSE) {

                $numero = count($data1);
                for ($c = 2; $c < $numero; $c++) {
                    $hojaclavescepre = new Hojaclavescepre();
                    $hojaclavescepre->LITHO = $data1[0];
                    $hojaclavescepre->CANAL = $data1[1];
                    $hojaclavescepre->idpregunta = $c - 1;
                    $hojaclavescepre->R = $data1[$c];
                    $hojaclavescepre->idProceso = $idProceso;
                    $hojaclavescepre->save();
                }
            }
            fclose($handle);
        }


        //        $ruta1  =  storage_path('calificacion') ."/". 'hojarespuestaX.dlm';

        return response()->json(['correcto' => $correcto]);
    }

    public function cargarInformacionTXTCepre3(Request $request)
    {

        if (!Proceso::abierto())
            return "Acceso Denegado";
        $correcto = "SI";

        //AGREGO 24/09/2018
        $proceso = DB::table('proceso')
            ->select('id', 'descripcion')
            ->where('activo', 1)
            ->get();

        $array = json_decode($proceso);
        $idProceso = "";
        $descripcion = "";
        foreach ($array as $obj) {
            $idProceso = $obj->id;
            $descripcion = $obj->descripcion;
        }

        $archivo4 = $request->file('archivo4');
        $nombreOriginal4 = $archivo4->getClientOriginalName();
        //AGREGO 24/09/2018
        $nombreOriginalProceso = $descripcion . $nombreOriginal4;

        $extension4 = $archivo4->getClientOriginalExtension();

        if ($extension4 == "dlm") {
            //MODIFICO 25/09/2018
            //$r4 = \Storage::disk('calificacioncepre')->put($nombreOriginal4, \File::get($archivo4));  
            $r4 = \Storage::disk('calificacioncepre')->put($nombreOriginalProceso, \File::get($archivo4));
        }

        //MODIFICO 25/09/2018
        //$ruta3  =  storage_path('calificacioncepre') ."/". $nombreOriginal4;        
        $ruta3  =  storage_path('calificacioncepre') . "/" . $nombreOriginalProceso;

        //AGREGO 25/09/2018 $hojaclavescepre ->idProceso=$idProceso;

        if (($handle = fopen($ruta3, 'r')) !== FALSE) {
            while (($data2 = fgetcsv($handle, 1000, ',')) !== FALSE) {

                $numero = count($data2);
                for ($c = 2; $c < $numero; $c++) {
                    $hojaclavescepre = new Hojaclavescepre();
                    $hojaclavescepre->LITHO = $data2[0];
                    $hojaclavescepre->CANAL = $data2[1];
                    $hojaclavescepre->idpregunta = $c - 1;
                    $hojaclavescepre->R = $data2[$c];
                    $hojaclavescepre->idProceso = $idProceso;
                    $hojaclavescepre->save();
                }
            }
            fclose($handle);
        }
        //        $ruta1  =  storage_path('calificacion') ."/". 'hojarespuestaX.dlm';

        return response()->json(['correcto' => $correcto]);
    }

    public function cargarInformacionTXTSimulacro(Request $request)
    {

        /*if(!Proceso::abierto())
            return "Acceso Denegado";
        $correcto="SI";
        
        //AGREGO 16/10/2018
        $proceso = DB::table('proceso')
                    ->select('id','descripcion')
                    ->where('activo',1)
                    ->get();

        $array = json_decode($proceso); 
        $idProceso="" ;
        $descripcion="";
        foreach($array as $obj){
            $idProceso= $obj->id;
            $descripcion= $obj->descripcion;
        }
        
        $archivo =$request->file('archivo');
        $nombreOriginal= $archivo->getClientOriginalName();
        //AGREGO 16/10/2018
        $nombreOriginalProceso = $descripcion.$nombreOriginal;
        $extension = $archivo->getClientOriginalExtension();
            
            if($extension=="dlm"){
                //MODIFICADO 16/10/2018
            //$r = \Storage::disk('calificacionsimulacro')->put($nombreOriginal, \File::get($archivo));
                $r = \Storage::disk('calificacionsimulacro')->put($nombreOriginalProceso, \File::get($archivo));
            }

        //MODIFICADO 16/10/2018
        //$ruta  =  storage_path('calificacionsimulacro') ."/". $nombreOriginal;
        $ruta  =  storage_path('calificacionsimulacro') ."/". $nombreOriginalProceso;
            
            if(($handle = fopen($ruta,'r'))!==FALSE){
                while(($data=fgetcsv($handle, 1000, ','))!==FALSE){

                    $hojaidentificacioncepre = new Hojaidentificacionsimulacro();
                    $hojaidentificacioncepre ->LITHO=$data[0];
                    $hojaidentificacioncepre ->CANAL=$data[1];
                    $hojaidentificacioncepre ->CODIGO=$data[2];
                    $hojaidentificacioncepre ->idProceso=$idProceso;
                    $hojaidentificacioncepre ->save();

                }
                fclose($handle);
            }
            
            //$array=(DB :: select( "SELECT COUNT(LITHO) as TOTAL FROM hojaidenticacion_simulacro_proceso"));   
            //AGREGADO 19/03/2019
            //$array=(DB :: select( "SELECT COUNT(LITHO) as TOTAL FROM hojaidenticacion_simulacro_proceso_3"));   
            //AGREGADO 25/10/2019
            //$array=(DB :: select( "SELECT COUNT(LITHO) as TOTAL FROM hojaidenticacion_simulacro_proceso_2020_1"));   
            //AGREGADO 06/03/2019
            $array=(DB :: select( "SELECT COUNT(LITHO) as TOTAL FROM hojaidenticacion_simulacro_proceso_2020_2"));   
        $id_fruta=0;
        foreach($array as $obj){
            $id_fruta = $obj->TOTAL;
        }
        
        $total=$id_fruta-2;

	
        	 return response()->json(['correcto' => $correcto, 'total' =>  $total]);*/


        if (!Proceso::abierto())
            return "Acceso Denegado";

        //AGREGO 24/09/2018
        $proceso = DB::table('proceso')
            ->select('id', 'descripcion')
            ->where('activo', 1)
            ->get();

        $array = json_decode($proceso);
        $idProceso = "";
        $descripcion = "";
        foreach ($array as $obj) {
            $idProceso = $obj->id;
            $descripcion = $obj->descripcion;
        }

        $correcto = "SI";
        $archivo = $request->file('archivo');
        $nombreOriginal = $archivo->getClientOriginalName();
        //AGREGO 25/09/2018
        $nombreOriginalProceso = $descripcion . $nombreOriginal;

        $extension = $archivo->getClientOriginalExtension();

        if ($extension == "dlm") {
            //MODIFICO 24/09/2018
            //$r = \Storage::disk('calificacioncepre')->put($nombreOriginal, \File::get($archivo));        
            $r = \Storage::disk('calificacionsimulacro')->put($nombreOriginalProceso, \File::get($archivo));
        }

        //MODIFICO 25/09/2018
        //$ruta  =  storage_path('calificacioncepre') ."/". $nombreOriginal;        
        $ruta  =  storage_path('calificacionsimulacro') . "/" . $nombreOriginalProceso;
        //AGREGO 24/09/2018 $hojaidentificacioncepre ->idProceso=$idProceso;

        $fila = 0;
        if (($handle = fopen($ruta, 'r')) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ',')) !== FALSE) {

                $hojaidentificacioncepre = new Hojaidentificacionsimulacro();
                if ($data[0] == 'LITHO') {
                } else {
                    $hojaidentificacioncepre->LITHO = $data[0];
                    $hojaidentificacioncepre->CANAL = $data[1];
                    $hojaidentificacioncepre->CODIGO = $data[2];
                    $hojaidentificacioncepre->AULA = $nombreOriginal;
                    $hojaidentificacioncepre->idProceso = $idProceso;
                    $hojaidentificacioncepre->save();
                    $fila++;
                    $numero = $fila;
                    $total = $numero;
                }
            }
            fclose($handle);
        }



        //        $ruta1  =  storage_path('calificacion') ."/". 'hojarespuestaX.dlm';

        return response()->json(['correcto' => $correcto, 'total' => $total]);
    }

    public function cargarInformacionTXTSimulacro1(Request $request)
    {

        if (!Proceso::abierto())
            return "Acceso Denegado";
        $correcto = "SI";

        //AGREGO 17/10/2018
        $proceso = DB::table('proceso')
            ->select('id', 'descripcion')
            ->where('activo', 1)
            ->get();

        $array = json_decode($proceso);
        $idProceso = "";
        $descripcion = "";
        foreach ($array as $obj) {
            $idProceso = $obj->id;
            $descripcion = $obj->descripcion;
        }

        $archivo2 = $request->file('archivo2');
        $nombreOriginal2 = $archivo2->getClientOriginalName();
        //AGREGO 17/10/2018
        $nombreOriginalProceso = $descripcion . $nombreOriginal2;
        $extension2 = $archivo2->getClientOriginalExtension();

        if ($extension2 == "dlm") {
            //MODIFICADO 17/10/2018
            //$r2 = \Storage::disk('calificacionsimulacro')->put($nombreOriginal2, \File::get($archivo2));  
            $r2 = \Storage::disk('calificacionsimulacro')->put($nombreOriginalProceso, \File::get($archivo2));
        }

        //MODIFICADO 17/10/2018
        //$ruta  =  storage_path('calificacionsimulacro') ."/". $nombreOriginal2;
        $ruta  =  storage_path('calificacionsimulacro') . "/" . $nombreOriginalProceso;

        //$ruta  =  storage_path('calificacionsimulacro') ."/". 'nombreOriginal2.dlm';
        $fila = 1;
        if (($handle = fopen($ruta, 'r')) !== FALSE) {

            while (($data = fgetcsv($handle, 1000, ',')) !== FALSE) {

                $numero = count($data);

                $fila++;

                for ($c = 2; $c < $numero; $c++) {

                    $hojarespuesta = new Hojarespuestasimulacro();
                    $hojarespuesta->LITHO = $data[0];
                    $hojarespuesta->CANAL = $data[1];
                    $hojarespuesta->ID = $c - 1;
                    $hojarespuesta->R = $data[$c];
                    $hojarespuesta->idProceso = $idProceso;
                    $hojarespuesta->save();
                }
            }
            fclose($handle);
        }


        return response()->json(['correcto' => $correcto]);
    }

    public function cargarInformacionTXTSimulacro2(Request $request)
    {

        if (!Proceso::abierto())
            return "Acceso Denegado";
        $correcto = "SI";

        //AGREGO 11/10/2018
        $proceso = DB::table('proceso')
            ->select('id', 'descripcion')
            ->where('activo', 1)
            ->get();

        $array = json_decode($proceso);
        $idProceso = "";
        $descripcion = "";
        foreach ($array as $obj) {
            $idProceso = $obj->id;
            $descripcion = $obj->descripcion;
        }

        $archivo3 = $request->file('archivo3');
        $nombreOriginal3 = $archivo3->getClientOriginalName();
        //AGREGO 11/10/2018
        $nombreOriginalProceso = $descripcion . $nombreOriginal3;
        $extension3 = $archivo3->getClientOriginalExtension();

        if ($extension3 == "dlm") {
            // MODIFICO 11/10/2018
            //$r3 = \Storage::disk('calificacionsimulacro')->put($nombreOriginal3, \File::get($archivo3));  
            $r3 = \Storage::disk('calificacionsimulacro')->put($nombreOriginalProceso, \File::get($archivo3));
        }

        //MODIFICO 11/10/2018
        //$ruta2  =  storage_path('calificacionsimulacro') ."/". $nombreOriginal3;
        $ruta2  =  storage_path('calificacionsimulacro') . "/" . $nombreOriginalProceso;

        if (($handle = fopen($ruta2, 'r')) !== FALSE) {
            while (($data1 = fgetcsv($handle, 1000, ',')) !== FALSE) {

                $numero = count($data1);
                for ($c = 2; $c < $numero; $c++) {
                    $hojaclavescepre = new Hojaclavessimulacro();
                    $hojaclavescepre->LITHO = $data1[0];
                    $hojaclavescepre->CANAL = $data1[1];
                    $hojaclavescepre->idpregunta = $c - 1;
                    $hojaclavescepre->R = $data1[$c];
                    $hojaclavescepre->idproceso = $idProceso;
                    $hojaclavescepre->save();
                }
            }
            fclose($handle);
        }


        return response()->json(['correcto' => $correcto]);
    }

    public function cargarInformacionTXTSimulacro3(Request $request)
    {

        if (!Proceso::abierto())
            return "Acceso Denegado";
        $correcto = "SI";
        $archivo4 = $request->file('archivo4');
        $nombreOriginal4 = $archivo4->getClientOriginalName();
        $extension4 = $archivo4->getClientOriginalExtension();

        if ($extension4 == "dlm") {
            $r4 = \Storage::disk('calificacionsimulacro')->put($nombreOriginal4, \File::get($archivo4));
        }


        $ruta3  =  storage_path('calificacionsimulacro') . "/" . $nombreOriginal4;

        if (($handle = fopen($ruta3, 'r')) !== FALSE) {
            while (($data2 = fgetcsv($handle, 1000, ',')) !== FALSE) {

                $numero = count($data2);
                for ($c = 2; $c < $numero; $c++) {
                    $hojaclavescepre = new Hojaclavessimulacro();
                    $hojaclavescepre->LITHO = $data2[0];
                    $hojaclavescepre->CANAL = $data2[1];
                    $hojaclavescepre->idpregunta = $c - 1;
                    $hojaclavescepre->R = $data2[$c];
                    $hojaclavescepre->save();
                }
            }
            fclose($handle);


            return response()->json(['correcto' => $correcto]);
        }
    }

    public function procesoRespuesta()
    {

        DB::statement('call sp_inserccion_calificar_admision()');

        return redirect('rep-calificacion'); //CALIFICACION ANTIGUA  


    }

    //CALIFICACION 2020 - 2
    public function procesoRespuesta2020II()
    {

        DB::statement('call sp_insercion_calificar_proceso_2020_2()');

        return redirect('rep-calificacion-2020-2'); //CALIFICACION 2020 - 2

        // return redirect('rep-calificacion');	//ALIFICACION ANTIGUA

    }

    public function procesoRespuesta2020II_canal_A()
    {

        DB::statement('call sp_insercion_calificar_proceso_2020_2_canal_A()');

        return redirect('rep-calificacion-2020-2_canal_A'); //CALIFICACION 2020 - 2

        // return redirect('rep-calificacion');	//ALIFICACION ANTIGUA

    }

    public function procesoRespuesta2020II_canal_B()
    {

        DB::statement('call sp_insercion_calificar_proceso_2020_2_canal_B()');

        return redirect('rep-calificacion-2020-2_canal_B'); //CALIFICACION 2020 - 2

        // return redirect('rep-calificacion');	//ALIFICACION ANTIGUA

    }

    public function procesoRespuesta2020II_canal_C()
    {

        DB::statement('call sp_insercion_calificar_proceso_2020_2_canal_C()');

        return redirect('rep-calificacion-2020-2_canal_C'); //CALIFICACION 2020 - 2

        // return redirect('rep-calificacion');	//ALIFICACION ANTIGUA

    }

    public function procesoRespuesta2020II_canal_D()
    {

        DB::statement('call sp_insercion_calificar_proceso_2020_2_canal_D()');

        return redirect('rep-calificacion-2020-2_canal_D'); //CALIFICACION 2020 - 2

        // return redirect('rep-calificacion');	//ALIFICACION ANTIGUA

    }

    public function procesoRespuestaCepre()
    {

        DB::statement('call sp_inserccion_calificar_cepre_4()');
        return redirect('rep-calificacion-cepre');
    }

    //AGREGADO 25/10/2018
    public function procesoRespuestaCepreII()
    {
        DB::statement('call sp_inserccion_calificar_cepre_4_2()');
        return redirect('rep-calificacion-cepre-II');
    }

    public function procesoRespuestaSimulacro()
    {
        DB::statement('call sp_inserccion_calificar_simulacro_2020_2()');
        return redirect('rep-calificacion-simulacro');
    }

    public function procesoClavesSolucionario()
    {

        $ruta  =  storage_path('calificacion') . "/" . 'hojaclaves.dlm';

        $existe = "";

        if (file_exists($ruta)) {
            if (($handle = fopen($ruta, 'r')) !== FALSE) {
                while (($data = fgetcsv($handle, 1000, ',')) !== FALSE) {

                    $hojaclaves = new Hojaclaves();
                    $hojaclaves->id = $data[0];
                    $hojaclaves->idpregunta = $data[1];
                    $hojaclaves->LITHO = $data[2];
                    $hojaclaves->CANAL = $data[3];
                    $hojaclaves->R = $data[4];
                    $hojaclaves->save();
                }
                fclose($handle);
            }
        } else {
            return redirect('rep-calificacion');
            return response()->json(['existe' => "NO"]);
        }
        return redirect('rep-calificacion');
        //	return redirect('rep-calificacion')->with("existe", $existe);	
        return response()->json(['existe' => $existe]);
    }

    public function postulantesCepre()
    {
        $procesos = Proceso::orderBy('id', 'desc')->get();
        return view('calificacionCepre')->with("procesos", $procesos);
    }

    public function postulantesSimulacro()
    {
        $procesos = Proceso::orderBy('id', 'desc')->get();
        return view('calificacionsimulacro')->with("procesos", $procesos);
    }

    public function listPostulatesCepre(Request $request)
    {
        $postulacion = null;
        if ($request->dato == 0)
            $request->tipo = 0;
        switch ($request->tipo) {

            case 2: #Por Escuela

                $postulaciones = (DB::select(DB::raw("call 	sp_calificar_cepre_escuela_4($request->dato)")));
                break;

            default:


                //$postulaciones=(DB :: select( DB :: raw ("call sp_calificar()")));
                $postulaciones = (DB::select(DB::raw("call sp_calificar_cepre_4()")));
                break;
        }
        return response()->json(['postulaciones' => $postulaciones]);
    }

    public function listPostulatesSimulacro(Request $request)
    {
        $postulacion = null;
        if ($request->dato == 0)
            $request->tipo = 0;
        switch ($request->tipo) {

            case 2: #Por Escuela

                //$postulaciones=(DB :: select( DB :: raw ("call  sp_calificar_simulacro_escuela($request->dato)")));        
                //CAMBIADO EL 06/03/2020
                $postulaciones = (DB::select(DB::raw("call 	sp_calificar_simulacro_escuela_2020_2($request->dato)")));
                break;
            default:


                //$postulaciones=(DB :: select( DB :: raw ("call sp_calificar()")));
                //$postulaciones=(DB :: select( DB :: raw ("call sp_calificar_simulacro()")));
                //CAMBIADO EL 06/03/2020
                $postulaciones = (DB::select(DB::raw("call sp_calificar_simulacro_2020_2()")));
                break;
        }
        return response()->json(['postulaciones' => $postulaciones]);
    }

    //AGREGO 28/09/2018
    public function postulantesCepreDuplicados()
    {
        $procesos = Proceso::orderBy('id', 'desc')->get();
        return view('calificacionCepreDuplicados')->with("procesos", $procesos);
    }
    //AGREGO 28/09/2018
    public function listPostulatesCepreDuplicados(Request $request)
    {
        $postulacion = null;
        if ($request->dato == 0)
            $request->tipo = 0;
        switch ($request->tipo) {
            case 2: #Por Escuela                
                $postulaciones = (DB::select(DB::raw("call  sp_calificar_cepre_duplicado(2,$request->dato)")));
                break;


            default:
                //$postulaciones=(DB :: select( DB :: raw ("call sp_calificar()")));
                $postulaciones = (DB::select(DB::raw("call sp_calificar_cepre_duplicado(1,0)")));
                break;
        }
        return response()->json(['postulaciones' => $postulaciones]);
    }

    public function postulantesCepreCanales()
    {
        $procesos = Proceso::orderBy('id', 'desc')->get();
        return view('calificacionCepreCanales')->with("procesos", $procesos);
    }

    //AGREGO 27/09/2018
    public function listPostulatesCepreCanales(Request $request)
    {
        $postulacion = null;
        if ($request->dato == 0)
            $request->tipo = 0;
        switch ($request->tipo) {
            case 2: #Por Escuela                
                $postulaciones = (DB::select(DB::raw("call  sp_calificar_cepre_canales(2,$request->dato,0)")));
                break;
            case 5: #Por Escuela                
                $postulaciones = (DB::select(DB::raw("call  sp_calificar_cepre_canales(3,0,$request->dato)")));
                break;



            default:
                //$postulaciones=(DB :: select( DB :: raw ("call sp_calificar()")));
                $postulaciones = (DB::select(DB::raw("call sp_calificar_cepre_canales(1,0,0)")));
                break;
        }
        return response()->json(['postulaciones' => $postulaciones]);
    }

    //AGREGADO 09/10/2018
    public function actualizarDuplicado(Request $request)
    {

        $hojaidentificacioncepre =
            DB::table('hojaidenticacion_cepre_proceso_4')->where('LITHO', $request->codlitho)->update(array('CODIGO' => $request->codpostulante));
        /*
        $hojaidentificacioncepre=
        DB::table('hojaidenticacion_cepre_proceso')->where('LITHO', $request->codlitho)->update(array('CODIGO'=>$request->codpostulante));*/
    }

    //AGREGADO 09/10/2018
    public function actualizarCanal(Request $request)
    {

        $hojaidentificacioncepre =
            DB::table('hojaidenticacion_cepre_proceso_4')->where('LITHO', $request->codlitho)->update(array('CANAL' => $request->canallitho));
    }

    //AGREGO 11/10/2018
    public function postulantesSimulacroCanales()
    {
        $procesos = Proceso::orderBy('id', 'desc')->get();
        return view('calificacionSimulacroCanales')->with("procesos", $procesos);
    }

    //AGREGO 11/10/2018
    public function listPostulatesSimulacroCanales(Request $request)
    {
        $postulacion = null;
        if ($request->dato == 0)
            $request->tipo = 0;
        switch ($request->tipo) {
            case 2: #Por Escuela                
                $postulaciones = (DB::select(DB::raw("call  sp_calificar_simulacro_canales(2,$request->dato,0)")));
                break;
            case 5: #Por Escuela                
                $postulaciones = (DB::select(DB::raw("call  sp_calificar_simulacro_canales(3,0,$request->dato)")));
                break;



            default:
                //$postulaciones=(DB :: select( DB :: raw ("call sp_calificar()")));
                $postulaciones = (DB::select(DB::raw("call sp_calificar_simulacro_canales(1,0,0)")));
                break;
        }
        return response()->json(['postulaciones' => $postulaciones]);
    }

    public function actualizarSimulacroCanal(Request $request)
    {

        $hojaidentificacioncepre =
            DB::table('hojaidenticacion_simulacro_proceso_2020_2')->where('LITHO', $request->codlitho)->update(array('CANAL' => $request->canallitho));
    }

    //AGREGO 11/10/2018
    public function postulantesSimulacroDuplicados()
    {
        $procesos = Proceso::orderBy('id', 'desc')->get();
        return view('calificacionSimulacroDuplicados')->with("procesos", $procesos);
    }
    //AGREGO 11/10/2018
    public function listPostulatesSimulacroDuplicados(Request $request)
    {
        $postulacion = null;
        if ($request->dato == 0)
            $request->tipo = 0;
        switch ($request->tipo) {
            case 2: #Por Escuela                
                $postulaciones = (DB::select(DB::raw("call  sp_calificar_simulacro_duplicado_2020_2(2,$request->dato)")));
                break;


            default:
                //$postulaciones=(DB :: select( DB :: raw ("call sp_calificar()")));
                $postulaciones = (DB::select(DB::raw("call sp_calificar_simulacro_duplicado_2020_2(1,0)")));
                break;
        }
        return response()->json(['postulaciones' => $postulaciones]);
    }

    //AGREGADO 11/10/2018
    public function actualizarSimulacroDuplicado(Request $request)
    {

        //$hojaidentificacioncepre=DB::table('hojaidenticacion_simulacro_proceso')->where('LITHO', $request->codlitho)->update(array('CODIGO'=>$request->codpostulante));
        //MODIFICADO 19/03/2019
        $hojaidentificacioncepre = DB::table('hojaidenticacion_simulacro_proceso_2020_2')->where('LITHO', $request->codlitho)->update(array('CODIGO' => $request->codpostulante));
    }

    //AGREGO 19/10/2018
    public function cargarInformacionCepre2()
    {
        if (!Proceso::abierto())
            return redirect("/");
        //       return view("cargartxt");
        $procesos = Proceso::orderBy('id', 'desc')->get();
        return view('cargartxtcepre2')->with('procesos', $procesos);
    }

    //AGREGO 22/10/2018
    public function cargarInformacionTXTCepreII(Request $request)
    {

        if (!Proceso::abierto())
            return "Acceso Denegado";

        //AGREGO 24/09/2018
        $proceso = DB::table('proceso')
            ->select('id', 'descripcion')
            ->where('activo', 1)
            ->get();

        $array = json_decode($proceso);
        $idProceso = "";
        $descripcion = "";
        foreach ($array as $obj) {
            $idProceso = $obj->id;
            $descripcion = $obj->descripcion;
        }

        $correcto = "SI";
        $archivo = $request->file('archivo');
        $nombreOriginal = $archivo->getClientOriginalName();
        //AGREGO 25/09/2018
        $nombreOriginalProceso = $descripcion . $nombreOriginal;

        $extension = $archivo->getClientOriginalExtension();

        if ($extension == "dlm") {
            //MODIFICO 24/09/2018
            //$r = \Storage::disk('calificacioncepre')->put($nombreOriginal, \File::get($archivo));        
            $r = \Storage::disk('calificacioncepreII')->put($nombreOriginalProceso, \File::get($archivo));
        }

        //MODIFICO 25/09/2018
        //$ruta  =  storage_path('calificacioncepre') ."/". $nombreOriginal;        
        $ruta  =  storage_path('calificacioncepreII') . "/" . $nombreOriginalProceso;
        //AGREGO 24/09/2018 $hojaidentificacioncepre ->idProceso=$idProceso;

        $fila = 0;
        if (($handle = fopen($ruta, 'r')) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ',')) !== FALSE) {

                $hojaidentificacioncepre = new HojaidentificacioncepreII();
                if ($data[0] == 'LITHO') {
                } else {
                    $hojaidentificacioncepre->LITHO = $data[0];
                    $hojaidentificacioncepre->CANAL = $data[1];
                    $hojaidentificacioncepre->CODIGO = $data[2];
                    $hojaidentificacioncepre->AULA = $nombreOriginal;
                    $hojaidentificacioncepre->idProceso = 4;
                    $hojaidentificacioncepre->save();
                    $fila++;
                    $numero = $fila;
                    $total = $numero;
                }
            }
            fclose($handle);
        }



        //        $ruta1  =  storage_path('calificacion') ."/". 'hojarespuestaX.dlm';

        return response()->json(['correcto' => $correcto]);
    }

    public function cargarInformacionTXTCepre1II(Request $request)
    {

        if (!Proceso::abierto())
            return "Acceso Denegado";
        $correcto = "SI";

        //AGREGO 24/09/2018
        $proceso = DB::table('proceso')
            ->select('id', 'descripcion')
            ->where('activo', 1)
            ->get();

        $array = json_decode($proceso);
        $idProceso = "";
        $descripcion = "";
        foreach ($array as $obj) {
            $idProceso = $obj->id;
            $descripcion = $obj->descripcion;
        }

        $archivo2 = $request->file('archivo2');
        $nombreOriginal2 = $archivo2->getClientOriginalName();

        //AGREGO 24/09/2018
        $nombreOriginalProceso = $descripcion . $nombreOriginal2;

        $extension2 = $archivo2->getClientOriginalExtension();

        if ($extension2 == "dlm") {
            //MODIFICO 25/09/2018
            //$r2 = \Storage::disk('calificacioncepre')->put($nombreOriginal2, \File::get($archivo2));  
            $r2 = \Storage::disk('calificacioncepreII')->put($nombreOriginalProceso, \File::get($archivo2));
        }

        //MODIFICO 25/09/2018
        //$ruta  =  storage_path('calificacioncepre') ."/". $nombreOriginal2;
        $ruta  =  storage_path('calificacioncepreII') . "/" . $nombreOriginalProceso;


        $fila = 1;
        if (($handle = fopen($ruta, 'r')) !== FALSE) {

            while (($data = fgetcsv($handle, 1000, ',')) !== FALSE) {

                $numero = count($data);

                $fila++;

                for ($c = 2; $c < $numero; $c++) {
                    $hojarespuesta = new HojarespuestacepreII();
                    $hojarespuesta->LITHO = $data[0];
                    $hojarespuesta->CANAL = $data[1];
                    $hojarespuesta->ID = $c - 1;
                    $hojarespuesta->R = $data[$c];
                    $hojarespuesta->idProceso = $idProceso;
                    $hojarespuesta->save();
                }
            }
            fclose($handle);
        }


        //        $ruta1  =  storage_path('calificacion') ."/". 'hojarespuestaX.dlm';

        return response()->json(['correcto' => $correcto]);
    }

    public function cargarInformacionTXTCepre2II(Request $request)
    {

        if (!Proceso::abierto())
            return "Acceso Denegado";
        $correcto = "SI";

        //AGREGO 24/09/2018
        $proceso = DB::table('proceso')
            ->select('id', 'descripcion')
            ->where('activo', 1)
            ->get();

        $array = json_decode($proceso);
        $idProceso = "";
        $descripcion = "";
        foreach ($array as $obj) {
            $idProceso = $obj->id;
            $descripcion = $obj->descripcion;
        }

        $archivo3 = $request->file('archivo3');
        $nombreOriginal3 = $archivo3->getClientOriginalName();
        //AGREGO 24/09/2018
        $nombreOriginalProceso3 = $descripcion . $nombreOriginal3;

        $extension3 = $archivo3->getClientOriginalExtension();

        if ($extension3 == "dlm") {
            //MODIFICO 24/09/2018 
            //$r3 = \Storage::disk('calificacioncepre')->put($nombreOriginal3, \File::get($archivo3));  
            $r3 = \Storage::disk('calificacioncepreII')->put($nombreOriginalProceso3, \File::get($archivo3));
        }

        //MODIFICADO 25/09/2018
        //$ruta2  =  storage_path('calificacioncepre') ."/". $nombreOriginal3;
        $ruta2  =  storage_path('calificacioncepreII') . "/" . $nombreOriginalProceso3;

        //AGREGO 24/09/2018 $hojaclavescepre ->idProceso=$idProceso;

        if (($handle = fopen($ruta2, 'r')) !== FALSE) {
            while (($data1 = fgetcsv($handle, 1000, ',')) !== FALSE) {

                $numero = count($data1);
                for ($c = 2; $c < $numero; $c++) {
                    $hojaclavescepre = new HojaclavescepreII();
                    $hojaclavescepre->LITHO = $data1[0];
                    $hojaclavescepre->CANAL = $data1[1];
                    $hojaclavescepre->idpregunta = $c - 1;
                    $hojaclavescepre->R = $data1[$c];
                    $hojaclavescepre->idProceso = $idProceso;
                    $hojaclavescepre->save();
                }
            }
            fclose($handle);
        }


        //        $ruta1  =  storage_path('calificacion') ."/". 'hojarespuestaX.dlm';

        return response()->json(['correcto' => $correcto]);
    }

    public function cargarInformacionTXTCepre3II(Request $request)
    {

        if (!Proceso::abierto())
            return "Acceso Denegado";
        $correcto = "SI";

        //AGREGO 24/09/2018
        $proceso = DB::table('proceso')
            ->select('id', 'descripcion')
            ->where('activo', 1)
            ->get();

        $array = json_decode($proceso);
        $idProceso = "";
        $descripcion = "";
        foreach ($array as $obj) {
            $idProceso = $obj->id;
            $descripcion = $obj->descripcion;
        }

        $archivo4 = $request->file('archivo4');
        $nombreOriginal4 = $archivo4->getClientOriginalName();
        //AGREGO 24/09/2018
        $nombreOriginalProceso = $descripcion . $nombreOriginal4;

        $extension4 = $archivo4->getClientOriginalExtension();

        if ($extension4 == "dlm") {
            //MODIFICO 25/09/2018
            //$r4 = \Storage::disk('calificacioncepre')->put($nombreOriginal4, \File::get($archivo4));  
            $r4 = \Storage::disk('calificacioncepreII')->put($nombreOriginalProceso, \File::get($archivo4));
        }

        //MODIFICO 25/09/2018
        //$ruta3  =  storage_path('calificacioncepre') ."/". $nombreOriginal4;        
        $ruta3  =  storage_path('calificacioncepreII') . "/" . $nombreOriginalProceso;

        //AGREGO 25/09/2018 $hojaclavescepre ->idProceso=$idProceso;

        if (($handle = fopen($ruta3, 'r')) !== FALSE) {
            while (($data2 = fgetcsv($handle, 1000, ',')) !== FALSE) {

                $numero = count($data2);
                for ($c = 2; $c < $numero; $c++) {
                    $hojaclavescepre = new HojaclavescepreII();
                    $hojaclavescepre->LITHO = $data2[0];
                    $hojaclavescepre->CANAL = $data2[1];
                    $hojaclavescepre->idpregunta = $c - 1;
                    $hojaclavescepre->R = $data2[$c];
                    $hojaclavescepre->idProceso = $idProceso;
                    $hojaclavescepre->save();
                }
            }
            fclose($handle);
        }
        //        $ruta1  =  storage_path('calificacion') ."/". 'hojarespuestaX.dlm';

        return response()->json(['correcto' => $correcto]);
    }

    //AGREGO 22/10/2018
    public function postulantesCepreDuplicadosII()
    {
        $procesos = Proceso::orderBy('id', 'desc')->get();
        return view('calificacionCepreDuplicadosII')->with("procesos", $procesos);
    }

    //AGREGO 22/10/2018
    public function listPostulatesCepreDuplicadosII(Request $request)
    {
        $postulacion = null;
        if ($request->dato == 0)
            $request->tipo = 0;
        switch ($request->tipo) {
            case 2: #Por Escuela                
                //$postulaciones=(DB :: select( DB :: raw ("call  sp_calificar_cepre_duplicadoII(2,$request->dato)")));     
                $postulaciones = (DB::select(DB::raw("call  sp_calificar_cepre_duplicado_2(2,$request->dato)")));
                break;


            default:
                //$postulaciones=(DB :: select( DB :: raw ("call sp_calificar()")));
                //$postulaciones=(DB :: select( DB :: raw ("call sp_calificar_cepre_duplicadoII(1,0)")));
                $postulaciones = (DB::select(DB::raw("call sp_calificar_cepre_duplicado_2(1,0)")));
                break;
        }
        return response()->json(['postulaciones' => $postulaciones]);
    }

    public function postulantesCepreCanalesII()
    {
        $procesos = Proceso::orderBy('id', 'desc')->get();
        return view('calificacionCepreCanalesII')->with("procesos", $procesos);
    }

    //AGREGO 22/09/2018
    public function listPostulatesCepreCanalesII(Request $request)
    {
        $postulacion = null;
        if ($request->dato == 0)
            $request->tipo = 0;
        switch ($request->tipo) {
            case 2: #Por Escuela                
                $postulaciones = (DB::select(DB::raw("call  sp_calificar_cepre_canalesII(2,$request->dato,0)")));
                break;
            case 5: #Por Escuela                
                $postulaciones = (DB::select(DB::raw("call  sp_calificar_cepre_canalesII(3,0,$request->dato)")));
                break;



            default:
                //$postulaciones=(DB :: select( DB :: raw ("call sp_calificar()")));
                $postulaciones = (DB::select(DB::raw("call sp_calificar_cepre_canalesII(1,0,0)")));
                break;
        }
        return response()->json(['postulaciones' => $postulaciones]);
    }

    //AGREGADO 22/10/2018
    public function actualizarDuplicadoII(Request $request)
    {

        $hojaidentificacioncepre =
            DB::table('hojaidenticacion_cepre_proceso_3_2')->where('LITHO', $request->codlitho)->update(array('CODIGO' => $request->codpostulante));
        /* $hojaidentificacioncepre=
        DB::table('hojaidenticacion_cepre_proceso2')->where('LITHO', $request->codlitho)->update(array('CODIGO'=>$request->codpostulante)); */
    }

    public function actualizarCanalII(Request $request)
    {

        $hojaidentificacioncepre =
            DB::table('hojaidenticacion_cepre_proceso2')->where('LITHO', $request->codlitho)->update(array('CANAL' => $request->canallitho));
    }

    //AGREGADO 24/10/2018
    public function postulantesCepreFinal()
    {
        $procesos = Proceso::orderBy('id', 'desc')->get();
        return view('calificacionCepreFinal')->with("procesos", $procesos);
    }

    //AGREGADO 24/10/2018
    public function listPostulatesCepreFinal(Request $request)
    {
        $postulacion = null;
        if ($request->dato == 0)
            $request->tipo = 0;
        switch ($request->tipo) {

            case 2: #Por Escuela

                $postulaciones = (DB::select(DB::raw("call  sp_calificar_cepre_resultado_final_escuela_4($request->dato)")));
                break;

            default:


                //$postulaciones=(DB :: select( DB :: raw ("call sp_calificar()")));
                $postulaciones = (DB::select(DB::raw("call sp_calificar_cepre_resultado_final_4()")));
                break;
        }
        return response()->json(['postulaciones' => $postulaciones]);
    }

    public function postulantesCepreII()
    {
        $procesos = Proceso::orderBy('id', 'desc')->get();
        return view('calificacionCepreII')->with("procesos", $procesos);
    }

    public function listPostulatesCepreII(Request $request)
    {
        $postulacion = null;
        if ($request->dato == 0)
            $request->tipo = 0;
        switch ($request->tipo) {

            case 2: #Por Escuela

                $postulaciones = (DB::select(DB::raw("call  sp_calificar_cepre_escuela_4_2($request->dato)")));
                break;

            default:


                //$postulaciones=(DB :: select( DB :: raw ("call sp_calificar()")));
                $postulaciones = (DB::select(DB::raw("call sp_calificar_cepre_4_2()")));
                break;
        }
        return response()->json(['postulaciones' => $postulaciones]);
    }

    public function actualizarAdmisionDuplicado(Request $request)
    {

        $hojaidentificacioncepre =
            DB::table('hojaidenticacion_proceso_3')->where('LITHO', $request->codlitho)->update(array('CODIGO' => $request->codpostulante));
    }

    public function actualizarAdmisionCanal(Request $request)
    {

        $hojaidentificacioncepre =
            DB::table('hojaidenticacion_proceso_3')->where('LITHO', $request->codlitho)->update(array('CANAL' => $request->canallitho));
    }

    /* ACTUALIZAR DUPLICADOS 2020-II*/
    public function actualizarAdmisionDuplicado2020II(Request $request)
    {

        //var_dump($request);
        $hojaidentificacioncepre = DB::table('hojaidenticacion_proceso_2020_2')->where('LITHO', $request->codlitho)->update(array('CODIGO' => $request->codpostulante));
    }

    public function actualizarAdmisionCanal2020II(Request $request)
    {

        $hojaidentificacioncepre =
            DB::table('hojaidenticacion_proceso_2020_2')->where('LITHO', $request->codlitho)->update(array('CANAL' => $request->canallitho));
    }
    /* FIN DE ACTUALIZAR DUPLICADOS 2020-II*/

    /* ACTUALIZAR DUPLICADOS 2020-II EXAMEN ESPECIAL*/
    public function actualizarAdmisionDuplicado2020IIESPECIAL(Request $request)
    {

        //var_dump($request);
        $hojaidentificacioncepre = DB::table('hojaidenticacion_proceso_2020_2_esp')->where('LITHO', $request->codlitho)->update(array('CODIGO' => $request->codpostulante));
    }

    public function actualizarAdmisionCanal2020IIESPECIAL(Request $request)
    {

        $hojaidentificacioncepre =
            DB::table('hojaidenticacion_proceso_2020_2_esp')->where('LITHO', $request->codlitho)->update(array('CANAL' => $request->canallitho));
    }
    /* FIN DE ACTUALIZAR DUPLICADOS 2020-II EXAMEN ESPECIAL*/

    public function postulantesCanales()
    {
        $procesos = Proceso::orderBy('id', 'desc')->get();
        return view('calificacionCanales')->with("procesos", $procesos);
    }

    //AGREGO 27/09/2018
    public function listPostulatesCanales(Request $request)
    {
        $postulacion = null;
        if ($request->dato == 0)
            $request->tipo = 0;
        switch ($request->tipo) {
            case 2: #Por Escuela                
                $postulaciones = (DB::select(DB::raw("call  sp_calificar_admision_canales(2,$request->dato,0)")));
                break;
            case 5: #Por Escuela                
                $postulaciones = (DB::select(DB::raw("call  sp_calificar_admision_canales(3,0,$request->dato)")));
                break;



            default:
                //$postulaciones=(DB :: select( DB :: raw ("call sp_calificar()")));
                $postulaciones = (DB::select(DB::raw("call sp_calificar_admision_canales(1,0,0)")));
                break;
        }
        return response()->json(['postulaciones' => $postulaciones]);
    }

    //AGREGO 25/10/2018
    public function postulantesDuplicados()
    {
        $procesos = Proceso::orderBy('id', 'desc')->get();
        return view('calificacionDuplicados')->with("procesos", $procesos);
    }

    //AGREGO 25/10/2018
    public function listPostulatesDuplicados(Request $request)
    {
        $postulacion = null;
        if ($request->dato == 0)
            $request->tipo = 0;
        switch ($request->tipo) {
            case 2: #Por Escuela                
                $postulaciones = (DB::select(DB::raw("call  sp_calificar_admision_duplicado(2,$request->dato)")));
                break;


            default:
                //$postulaciones=(DB :: select( DB :: raw ("call sp_calificar()")));
                $postulaciones = (DB::select(DB::raw("call sp_calificar_admision_duplicado(1,0)")));
                break;
        }
        return response()->json(['postulaciones' => $postulaciones]);
    }

    /* PARA DUPLICADOS 2020 II*/

    public function postulantesDuplicados2020II()
    {
        $procesos = Proceso::orderBy('id', 'desc')->get();

        return view('calificacionDuplicados-2020-2')->with("procesos", $procesos);
    }

    public function listPostulatesDuplicados2020II(Request $request)
    {
        $postulacion = null;
        if ($request->dato == 0)
            $request->tipo = 0;
        switch ($request->tipo) {
            case 2: #Por Escuela                
                // $postulaciones = (DB::select(DB::raw("call  sp_calificar_admision_duplicado(2,$request->dato)"))); //ANTIGUO
                $postulaciones = (DB::select(DB::raw("call  sp_calificar_admision_duplicado_2020_2(2,$request->dato)"))); // NUEVO
                break;


            default:
                //$postulaciones=(DB :: select( DB :: raw ("call sp_calificar()")));
                // $postulaciones = (DB::select(DB::raw("call sp_calificar_admision_duplicado(1,0)"))); //ANTIGUO
                $postulaciones = (DB::select(DB::raw("call sp_calificar_admision_duplicado_2020_2(1,0)"))); // NUEVO
                break;
        }
        return response()->json(['postulaciones' => $postulaciones]);
    }

    /* FIN DUPLICADOS 2020 II*/


    /* PARA DUPLICADOS DE ESPECIAL 2020-II */

    public function postulantesDuplicados2020IIESPECIAL()
    {
        $procesos = Proceso::orderBy('id', 'desc')->get();

        return view('calificacionDuplicados-2020-2-E')->with("procesos", $procesos);
    }

    public function listPostulatesDuplicados2020IIESPECIAL(Request $request)
    {
        $postulacion = null;
        if ($request->dato == 0)
            $request->tipo = 0;
        switch ($request->tipo) {
            case 2: #Por Escuela                
                // $postulaciones = (DB::select(DB::raw("call  sp_calificar_admision_duplicado(2,$request->dato)"))); //ANTIGUO
                $postulaciones = (DB::select(DB::raw("call  sp_calificar_admision_duplicado_2020_2_E(2,$request->dato)"))); // NUEVO
                break;


            default:
                //$postulaciones=(DB :: select( DB :: raw ("call sp_calificar()")));
                // $postulaciones = (DB::select(DB::raw("call sp_calificar_admision_duplicado(1,0)"))); //ANTIGUO
                $postulaciones = (DB::select(DB::raw("call sp_calificar_admision_duplicado_2020_2_E(1,0)"))); // NUEVO
                break;
        }
        return response()->json(['postulaciones' => $postulaciones]);
    }

    /* FIN DUPLICADOS ESPECIAL 2020-II */


    public function postulantesCanalesHR()
    {
        $procesos = Proceso::orderBy('id', 'desc')->get();
        return view('calificacionCanalesHR')->with("procesos", $procesos);
    }

    //AGREGO 27/09/2018
    public function listPostulatesCanalesHR(Request $request)
    {
        $postulacion = null;
        if ($request->dato == 0)
            $request->tipo = 0;
        switch ($request->tipo) {
            case 2: #Por Escuela                
                $postulaciones = (DB::select(DB::raw("call  sp_calificar_admision_canales_HR(2,$request->dato,0)")));
                break;
            case 5: #Por Escuela                
                $postulaciones = (DB::select(DB::raw("call  sp_calificar_admision_canales_HR(3,0,$request->dato)")));
                break;



            default:
                //$postulaciones=(DB :: select( DB :: raw ("call sp_calificar()")));
                $postulaciones = (DB::select(DB::raw("call sp_calificar_admision_canales_HR(1,0,0)")));
                break;
        }
        return response()->json(['postulaciones' => $postulaciones]);
    }

    public function actualizarAdmisionCanalHR(Request $request)
    {

        $hojaidentificacioncepre =
            DB::table('hojarespuesta_proceso_3')->where('LITHO', $request->codlitho)->update(array('CANAL' => $request->canallitho));
    }

    //AGREGO 14/02/2019
    public function postulantesCepreCanalesHR()
    {
        $procesos = Proceso::orderBy('id', 'desc')->get();
        return view('calificacionCepreCanalesHR')->with("procesos", $procesos);
    }

    //AGREGO 14/02/2019
    public function listPostulatesCepreCanalesHR(Request $request)
    {
        $postulacion = null;
        if ($request->dato == 0)
            $request->tipo = 0;
        switch ($request->tipo) {
            case 2: #Por Escuela                
                $postulaciones = (DB::select(DB::raw("call  sp_calificar_cepre_canales_HR_4(2,$request->dato,0)")));
                break;
            case 5: #Por Escuela                
                $postulaciones = (DB::select(DB::raw("call  sp_calificar_cepre_canales_HR_4(3,0,$request->dato)")));
                break;



            default:
                //$postulaciones=(DB :: select( DB :: raw ("call sp_calificar()")));
                $postulaciones = (DB::select(DB::raw("call sp_calificar_cepre_canales_HR_4(1,0,0)")));
                break;
        }
        return response()->json(['postulaciones' => $postulaciones]);
    }

    //AGREGADO 16/02/2019
    public function actualizarCepreCanalHR(Request $request)
    {

        $hojaidentificacioncepre =
            DB::table('hojarespuesta_cepre_proceso_4')->where('LITHO', $request->codlitho)->update(array('CANAL' => $request->canallitho));
    }

    //AGREGO 15/02/2018
    public function postulantesCepreCanalesHI()
    {
        $procesos = Proceso::orderBy('id', 'desc')->get();
        return view('calificacionCepreCanalesHI')->with("procesos", $procesos);
    }

    public function listPostulatesCepreCanalesHI(Request $request)
    {
        $postulacion = null;
        if ($request->dato == 0)
            $request->tipo = 0;
        switch ($request->tipo) {
            case 2: #Por Escuela                
                $postulaciones = (DB::select(DB::raw("call  sp_calificar_cepre_canales_HI_4(2,$request->dato,0)")));
                break;
            case 5: #Por Escuela                
                $postulaciones = (DB::select(DB::raw("call  sp_calificar_cepre_canales_HI_4(3,0,$request->dato)")));
                break;



            default:
                //$postulaciones=(DB :: select( DB :: raw ("call sp_calificar()")));
                // $postulaciones=(DB :: select( DB :: raw ("call sp_calificar_cepre_canales_HI(1,0,0)")));
                //$postulaciones=(DB :: select( DB :: raw ("call sp_calificar_cepre_canales_HI(2,1,0)")));
                $postulaciones = (DB::select(DB::raw("call sp_calificar_cepre_canales_HI_4(1,0,0)")));
                break;
        }
        return response()->json(['postulaciones' => $postulaciones]);
    }


    //AGREGADO 16/02/2019
    public function actualizarCepreCanalHI(Request $request)
    {

        $hojaidentificacioncepre =
            DB::table('hojaidenticacion_cepre_proceso_4')->where('LITHO', $request->codlitho)->update(array('CANAL' => $request->canallitho));
    }

    //AGREGO 20/02/2019
    public function postulantesCepreCanalesHR_2()
    {
        $procesos = Proceso::orderBy('id', 'desc')->get();
        return view('calificacionCepreCanalesHR_2')->with("procesos", $procesos);
    }

    //AGREGO 20/02/2019
    public function listPostulatesCepreCanalesHR_2(Request $request)
    {
        $postulacion = null;
        if ($request->dato == 0)
            $request->tipo = 0;
        switch ($request->tipo) {
            case 2: #Por Escuela                
                $postulaciones = (DB::select(DB::raw("call  sp_calificar_cepre_canales_HR_4_2(2,$request->dato,0)")));
                break;
            case 5: #Por Escuela                
                $postulaciones = (DB::select(DB::raw("call  sp_calificar_cepre_canales_HR_4_2(3,0,$request->dato)")));
                break;



            default:
                //$postulaciones=(DB :: select( DB :: raw ("call sp_calificar()")));
                $postulaciones = (DB::select(DB::raw("call sp_calificar_cepre_canales_HR_4_2(1,0,0)")));
                break;
        }
        return response()->json(['postulaciones' => $postulaciones]);
    }

    //AGREGADO 20/02/2019
    public function actualizarCepreCanalHR_2(Request $request)
    {

        $hojaidentificacioncepre =
            DB::table('hojarespuesta_cepre_proceso_4_2')->where('LITHO', $request->codlitho)->update(array('CANAL' => $request->canallitho));
    }

    //AGREGO 20/02/2018
    public function postulantesCepreCanalesHI_2()
    {
        $procesos = Proceso::orderBy('id', 'desc')->get();
        return view('calificacionCepreCanalesHI_2')->with("procesos", $procesos);
    }

    //AGREGO 20/0
    public function listPostulatesCepreCanalesHI_2(Request $request)
    {
        $postulacion = null;
        if ($request->dato == 0)
            $request->tipo = 0;
        switch ($request->tipo) {
            case 2: #Por Escuela                
                $postulaciones = (DB::select(DB::raw("call  sp_calificar_cepre_canales_HI_4_2(2,$request->dato,0)")));
                break;
            case 5: #Por Escuela                
                $postulaciones = (DB::select(DB::raw("call  sp_calificar_cepre_canales_HI_4_2(3,0,$request->dato)")));
                break;



            default:
                $postulaciones = (DB::select(DB::raw("call sp_calificar_cepre_canales_HI_4_2(1,0,0)")));
                break;
        }
        return response()->json(['postulaciones' => $postulaciones]);
    }


    //AGREGADO 20/02/2019
    public function actualizarCepreCanalHI_2(Request $request)
    {

        $hojaidentificacioncepre =
            DB::table('hojaidenticacion_cepre_proceso_4_2')->where('LITHO', $request->codlitho)->update(array('CANAL' => $request->canallitho));
    }

    public function postulantesSimulacroCanalesHI()
    {
        $procesos = Proceso::orderBy('id', 'desc')->get();
        return view('calificacionSimulacroCanalesHI')->with("procesos", $procesos);
    }

    //AGREGO 20/0
    public function listPostulatesSimulacroCanalesHI(Request $request)
    {
        $postulacion = null;
        if ($request->dato == 0)
            $request->tipo = 0;
        switch ($request->tipo) {
            case 2: #Por Escuela                
                $postulaciones = (DB::select(DB::raw("call  sp_calificar_simulacro_canales_HI_2020_2(2,$request->dato,0)")));
                break;
            case 5: #Por Escuela                
                $postulaciones = (DB::select(DB::raw("call  sp_calificar_simulacro_canales_HI_2020_2(3,0,$request->dato)")));
                break;



            default:
                $postulaciones = (DB::select(DB::raw("call sp_calificar_simulacro_canales_HI_2020_2(1,0,0)")));
                break;
        }
        return response()->json(['postulaciones' => $postulaciones]);
    }

    //AGREGADO 20/03/2019
    public function actualizarSimulacroCanalHI(Request $request)
    {

        $hojaidentificacioncepre =
            DB::table('hojaidenticacion_simulacro_proceso_2020_2')->where('LITHO', $request->codlitho)->update(array('CANAL' => $request->canallitho));
    }

    public function postulantesSimulacroCanalesHR()
    {
        $procesos = Proceso::orderBy('id', 'desc')->get();
        return view('calificacionSimulacroCanalesHR')->with("procesos", $procesos);
    }

    //AGREGO 14/02/2019
    public function listPostulatesSimulacroCanalesHR(Request $request)
    {
        $postulacion = null;
        if ($request->dato == 0)
            $request->tipo = 0;
        switch ($request->tipo) {
            case 2: #Por Escuela                
                $postulaciones = (DB::select(DB::raw("call  sp_calificar_simulacro_canales_HR_2020_2(2,$request->dato,0)")));
                break;
            case 5: #Por Escuela                
                $postulaciones = (DB::select(DB::raw("call  sp_calificar_simulacro_canales_HR_2020_2(3,0,$request->dato)")));
                break;



            default:
                //$postulaciones=(DB :: select( DB :: raw ("call sp_calificar()")));
                $postulaciones = (DB::select(DB::raw("call sp_calificar_simulacro_canales_HR_2020_2(1,0,0)")));
                break;
        }
        return response()->json(['postulaciones' => $postulaciones]);
    }

    //AGREGADO 16/02/2019
    public function actualizarSimulacroCanalHR(Request $request)
    {

        $hojaidentificacioncepre =
            DB::table('hojarespuesta_simulacro_proceso_2020_2')->where('LITHO', $request->codlitho)->update(array('CANAL' => $request->canallitho));
    }

    public function ReporteCalificacionPorPostulante()
    {
        $procesos = Proceso::orderBy('id', 'desc')->get();
        return view('reporte.ReporteCalificacionPorPostulante')->with("procesos", $procesos);
    }

    public function ReporteCalificacionPorPostulante2020II()
    {
        $procesos = Proceso::orderBy('id', 'desc')->get();
        return view('reporte.ReporteCalificacionPorPostulante20202')->with("procesos", $procesos);
    }

    public function listarReporteCalificacionPorPostulante(Request $request)
    {
        $txtcodigo = $request->codigopostulante;
        if ($txtcodigo == '') {
            $postulaciones = (DB::select(DB::raw("CALL P_OBT_ADM_REPORTE_MARCADO_POSTULANTE(0)")));
        } else {
            $postulaciones = (DB::select(DB::raw("CALL P_OBT_ADM_REPORTE_MARCADO_POSTULANTE($txtcodigo)")));
        }


        return response()->json(['postulaciones' => $postulaciones]);
    }


    public function listarReporteCalificacionPorPostulante2020II(Request $request)
    {
        $txtcodigo = $request->codigopostulante;
        if ($txtcodigo == '') {
            $postulaciones = (DB::select(DB::raw("CALL P_OBT_ADM_REPORTE_MARCADO_POSTULANTE_2020_2(0)")));
        } else {
            $postulaciones = (DB::select(DB::raw("CALL P_OBT_ADM_REPORTE_MARCADO_POSTULANTE_2020_2($txtcodigo)")));
        }


        return response()->json(['postulaciones' => $postulaciones]);
    }


    public function ReporteCalificacionPorPostulanteCepre()
    {
        $procesos = Proceso::orderBy('id', 'desc')->get();
        return view('reporte.ReporteCalificacionPorPostulanteCepre')->with("procesos", $procesos);
    }

    public function listarReporteCalificacionPorPostulanteCepre(Request $request)
    {
        $txtcodigo = $request->codigopostulante;
        if ($txtcodigo == '') {
            $postulaciones = (DB::select(DB::raw("CALL P_OBT_ADM_REPORTE_MARCADO_POSTULANTE_CEPRE(0)")));
        } else {
            $postulaciones = (DB::select(DB::raw("CALL P_OBT_ADM_REPORTE_MARCADO_POSTULANTE_CEPRE($txtcodigo)")));
        }


        return response()->json(['postulaciones' => $postulaciones]);
    }

    public function ReporteCalificacionPorPostulanteCepre2()
    {
        $procesos = Proceso::orderBy('id', 'desc')->get();
        return view('reporte.ReporteCalificacionPorPostulanteCepre2')->with("procesos", $procesos);
    }

    public function listarReporteCalificacionPorPostulanteCepre2(Request $request)
    {
        $txtcodigo = $request->codigopostulante;
        if ($txtcodigo == '') {
            $postulaciones = (DB::select(DB::raw("CALL P_OBT_ADM_REPORTE_MARCADO_POSTULANTE_CEPRE_2(0)")));
        } else {
            $postulaciones = (DB::select(DB::raw("CALL P_OBT_ADM_REPORTE_MARCADO_POSTULANTE_CEPRE_2($txtcodigo)")));
        }


        return response()->json(['postulaciones' => $postulaciones]);
    }
}
