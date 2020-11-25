<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Proceso;
use Validator;

class ProcesoController extends Controller
{
    public function index()
    {
    	return view('mantenimiento.proceso');
    }
    public function lista()
    {
    	$procesos = Proceso::select('id', 'descripcion', 'activo', 
    									'costocarpeta', 'costoprospecto', 'responsable', 'director',
    									'fechaexaordinario', 'fechaexaextraordinario', 'resolucion')->get();
		return response()->json(['procesos' => $procesos]);
    }
    public function create(Request $request)
    {
    	$messages = [
    		'descripcion.required' => 'Ingrese la descripción del proceso.',
    		'descripcion.regex' => 'Ingrese la descripción del proceso de forma correcta.',
    		'descripcion.unique' => 'El nombre de proceso ya existe.',
    		'director.required' => 'Ingrese el nombre completo del director.',
    		'director.min' => 'Ingrese el nombre correcto del director.',
    		'responsable.required' => 'Ingrese el nombre completo del responsable.',
    		'responsable.min' => 'Ingrese el nombre correcto del responsable.',
    		'resolucion.required' => 'Ingrese la resolución.',
    		'resolucion.min' => 'Ingrese de forma correcta la resolución.',
    		'fecharesolucion.required' => 'Ingrese la fecha de la resolución.',
    		'costocarpeta.required' => 'Ingrese el costo de la carpeta.',
    		'costoprospecto.required' => 'Ingrese el costo del prospecto.',
    		'fechaexaordinario.required' => 'Ingrese la fecha del examen ordinario.',
    		'fechaexaextraordinario.required' => 'Ingrese la fecha del examen extraordinario.',
    	];
    	$validator = Validator::make($request->all(), [
    		'descripcion' => 'required|regex:/20[0-9]{2}-II?/|unique:proceso,descripcion',
    		'director' => 'required|min:5',
    		'responsable' => 'required|min:5',
    		'resolucion' => 'required|min:2',
    		'fecharesolucion' => 'required|date',
    		'costocarpeta' => 'required|numeric',
    		'costoprospecto' => 'required|numeric',
    		'fechaexaordinario' => 'required|date',
    		'fechaexaextraordinario' => 'required|date'
    	], $messages)->validate();
    	$procesoabierto = Proceso::abierto();

    	if($procesoabierto){
    		$procesoabierto->activo = 0;
    		$procesoabierto->save();
    		return $procesoabierto;
    	}
    	$proceso = new Proceso;
    	$proceso->descripcion = $request->descripcion;
    	$proceso->activo = 1;
    	$proceso->activopostulacion = 1;
    	$proceso->costocarpeta = $request->costocarpeta;
    	$proceso->costoprospecto = $request->costoprospecto;
    	$proceso->responsable = $request->responsable;
    	$proceso->director = $request->director;
    	$proceso->fechaexaordinario = $request->fechaexaordinario;
    	$proceso->fechaexaextraordinario = $request->fechaexaextraordinario;
    	$proceso->resolucion = $request->resolucion;
    	$proceso->fecharesolucion = $request->fecharesolucion;
    	if($proceso->save())
    		return response()->json(["success" => true,
    									"message" => "Proceso guardado y activado de forma correcta."]);
    }
    public function terminarProceso(Request $request)
    {
    	$proceso = Proceso::find($request->id);
    	if($proceso){
    		$proceso->activo = 0;
    		$proceso->activopostulacion = 0;
    		if($proceso->save())
    			return response()->json(['success' => true, 'message' => 'Proceso '.$proceso->descripcion.' terminado de forma correcta.']);
    	}
    	return response()->json(['success' => false, 'message' => 'Ocurrio un problema, intentelo nuevamente.']);
    }
    public function editarResolucion(Request $request)
    {
        $proceso = Proceso::find($request->id);
        if(!$proceso)
            return response()->json(['success' => false, 'message' => 'Proceso no existe.']);
        if(!$proceso->activo)
            return response()->json(['success' => false, 'message' => 'Este proceso esta finalizado.']);

        $proceso->resolucion = $request->resolucion;
        if($proceso->save())
            return response()->json(['success' => true, 'message' => 'Resolución cambiada con éxito.']);
        else
            return response()->json(['success' => false, 'message' => 'No se pudo modificar.']);
    }
}
