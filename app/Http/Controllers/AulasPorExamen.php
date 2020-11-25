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

class AulasPorExamen extends Controller
{

public function __construct()
    {
        $this->middleware('auth');
    }

  public function index()
    {
    	
       $areas = Area::allactivo();
  
        return view('mantenimiento.aulas')->with('areas', $areas);

    }
   
   public function indextarifa()
   {
   	$tarifa=Tarifa::allactivo();       
       
        return view('mantenimiento.tarifa')->with('tarifa',$tarifa);
   }

    public function listaX(){

        $tarifas=Tarifa::join('modalidad','Tarifa.idmodalidad','=','Modalidad.id')
        ->select('tarifa.id as idtarifa','modalidad.id as idmodalidad','modalidad.descripcion as descripcionmodalidad','tarifa.descripcion','tarifa.nota','tarifa.costotarifa')
        ->get();
        return response()->json(['tarifas'=>$tarifas]);
    }

  public function listaAulasTipoExamen()
    {
    	
        $Aulas =Ambiente::join('area', 'ambiente.idarea', '=', 'area.id')        
            ->select('ambiente.id as idAmbiente','ambiente.descripcion as descripcionAmbiente', 'area.descripcion as descripcionarea', 'area.nombre','ambiente.capacidad','ambiente.ubicacion','area.id as areaid','ambiente.proyector','ambiente.estado')
            ->where('ambiente.estado', '=', '1')
            ->orderBy('descripcionarea', 'asc')
            ->orderBy('ambiente.proyector', 'asc')
            ->get();

        return response()->json(['aulas' => $Aulas]);

    }

    
 public function guardarAula(Request $request)
    {
        $messages = [
            'descripcion.required' => 'Ingrese el nombre de aula.',
            'CapacidadAula.numeric' => 'Ingrese un número de capacidad correcto.',
            'isoarea.required' => 'Seleccione una modalidad.',
        ];
        $validator = Validator::make($request->all(), [
            'descripcion' => 'required|',
            'CapacidadAula' => 'required|numeric|min:3',
            'isoarea' => 'required|exists:area,id',

        ], $messages)->validate();

      
          
       $ambiente = new Ambiente;
        $ambiente->idarea = $request->isoarea;
        $ambiente ->capacidad = $request->CapacidadAula;
        $ambiente ->descripcion= $request->descripcion;
        $ambiente->ubicacion= $request->ubicacionAula;      
        $ambiente ->estado = 1;
        $ambiente ->proyector = $request->ordenCobertura;
        if($ambiente->save())
        {
            $msg = "Datos guardados correctamente.";
            return response()->json(['success' => true,
                                        'message' => $msg]);
        }




    }   

public function eliminaraulas(Request $request)
{
    $ambiente=Ambiente::where('id', '=', $request->id)->first();
    

    if($ambiente->delete())
                return response()->json(['success' => true, 'message' => ' Eliminado de forma correcta.']);
}



public function borradologico(Request $request) {

   //  $ambiente=Ambiente::findOrFail($request->id);

 //if($ambiente->delete())
                //return response()->json(['success' => true, 'message' => ' Eliminado de forma correcta.']);


        $ambiente=Ambiente::findOrFail($request->id);     
        $ambiente ->estado =0;
        if($ambiente->save())
        {
            $msg = "Datos Eliminados correctamente.";
            return response()->json(['success' => true,
                                        'message' => $msg]);
        }


}

public function guardarAula1(Request $request)
    {
        $messages = [
            'descripcion1.required' => 'Ingrese el nombre de aula.',
            'CapacidadAula1.numeric' => 'Ingrese un número de capacidad correcto.',
            'isoarea1.required' => 'Seleccione una modalidad.',
        ];
        $validator = Validator::make($request->all(), [
            'descripcion1' => 'required|',
            'CapacidadAula1' => 'required|numeric|',
            'isoarea1' => 'required|exists:area,id',

        ], $messages)->validate();

      
          
        $ambiente=Ambiente::findOrFail($request->codAmbiente1);
        $ambiente->idarea = $request->isoarea1;
        $ambiente ->capacidad = $request->CapacidadAula1;
        $ambiente ->descripcion= $request->descripcion1;
        $ambiente->ubicacion= $request->ubicacionAula1;      
        $ambiente ->estado = 1;
        $ambiente ->proyector = $request->ordenCobertura;
        if($ambiente->save())
        {
            $msg = "Datos Actualizados correctamente.";
            return response()->json(['success' => true,
                                        'message' => $msg]);
        }




    }   



}
