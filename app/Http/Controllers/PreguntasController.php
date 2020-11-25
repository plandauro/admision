<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use DB;
use App\Preguntas;
use App\Dificultad;
use App\Materia;
use App\Proceso;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Storage;
use File;

class PreguntasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        //
        $procesos = Proceso::orderBy('id', 'desc')->get();
        $materias = Materia::allactivo();
        $dificultades = Dificultad::allactivo();
        return view('mantenimiento.preguntas')->with('materias', $materias)
					    ->with('dificultad', $dificultades)
                                            ->with("procesos", $procesos);
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

    public function listaPreguntas(Request $request){
        if($request->dato == 0)
            $request->tipo = 0;
        switch ($request->tipo) {
            case 6: #Por Escuela                
                $materia = Preguntas::join('materia as mat','preguntas.id_materia','=','mat.id')
		->join('dificultad as dif','preguntas.id_dificultad','=','dif.id')
                ->select('preguntas.id as cod','mat.nombre as nombremateria','dif.nombre as nombredificultad','dif.id as iddificultad','mat.id as idmateria','pregunta','A1','A2','A3','A4','A5','AC','preguntas.estado')
                ->where('preguntas.estado','=','1')
                ->where('preguntas.idproceso','=',$request->idproceso)
                ->where('mat.id','=',$request->dato)
                ->get();   
                break;


          
            default:         
            $materia = Preguntas::join('materia as mat','preguntas.id_materia','=','mat.id')
		->join('dificultad as dif','preguntas.id_dificultad','=','dif.id')
                ->select('preguntas.id as cod','mat.nombre as nombremateria','dif.nombre as nombredificultad','dif.id as iddificultad','mat.id as idmateria','pregunta','A1','A2','A3','A4','A5','AC','preguntas.estado')
                ->where('preguntas.estado','=','1')
                ->where('preguntas.idproceso','=',$request->idproceso)
                ->get();
            break;
        }

      return response()->json(['postulaciones' => $materia]);
    }  

    public function actualizarPreguntas(Request $request){      
      $pregunta=Preguntas::where('id', '=', $request->codigo)->first();
      if(count($pregunta)>=1){
        $pregunta->id_materia=$request->idmateria;
        $pregunta->id_dificultad=$request->iddificultad;
        $pregunta->pregunta=$request->descripcion;
        $pregunta->A1=$request->a1;
        $pregunta->A2=$request->a2;
        $pregunta->A3=$request->a3;
        $pregunta->A4=$request->a4;
        $pregunta->A5=$request->a5;
        $pregunta->AC=$request->ac;
        $pregunta->estado=1;
        $pregunta->save();
      }
    }

    public function crearPreguntas(Request $request){ 

        $proceso = DB::table('proceso')
                    ->select('id','descripcion')
                    ->where('activo',1)
                    ->get();

        $array = json_decode($proceso); 
        $idProceso="" ;
        $descripcion="";
        foreach($array as $obj){
            $idProceso= $obj->id;
        }         
        $pregunta= new Preguntas();
        $pregunta->id_materia=$request->idmateria;
        $pregunta->id_dificultad=$request->iddificultad;
        $pregunta->pregunta=$request->descripcion;
        $pregunta->A1=$request->a1;
        $pregunta->A2=$request->a2;
        $pregunta->A3=$request->a3;
        $pregunta->A4=$request->a4;
        $pregunta->A5=$request->a5;
        $pregunta->AC=$request->ac;
        $pregunta->estado=1;
        $pregunta->idproceso=$idProceso;
        $pregunta->save();
    }

     public function eliminarPreguntas(Request $request){      
      $proceso = DB::table('proceso')
                    ->select('id','descripcion')
                    ->where('activo',1)
                    ->get();

        $array = json_decode($proceso); 
        $idProceso="" ;
        $descripcion="";
        foreach($array as $obj){
            $idProceso= $obj->id;
        }         
      $materia=Preguntas::where('id', '=', $request->codigo)->first();
      if(count($materia)>=1){
        $materia->estado=0;
        $materia->idproceso_usado=$idProceso;
        $materia->save();
      }
    }  

    public function cargarPreguntas(){
        if(!Proceso::abierto())
            return redirect("/");
       return view("cargarPreguntas");

    }  

    public function cargarPreguntasExcel(Request $request)
    {
        if(!Proceso::abierto())
            return "Acceso Denegado";
       $archivo = $request->file('archivo');
       
       $correcto = 0;
        $total = 0;
        $nombre_original=$archivo->getClientOriginalName();
        $extension=$archivo->getClientOriginalExtension();
        $ruta2  =  storage_path('archivos') ."/". $nombre_original;
        $existe="";
        if($extension!="xlsx" && $extension!="xls"){
            return response()->json(['correcto' => "",
                                    'total' => "",'existe' => "bien"]);
        }else{

            if ( File :: exists ( $ruta2 )) { 
                
        return response()->json(['correcto' => "",
                                    'total' => "",'existe' => "SI"]);
        
        }else{
    $archivo = $request->file('archivo');
            $nombre_original=$archivo->getClientOriginalName();
       $extension=$archivo->getClientOriginalExtension();
       $r1=Storage::disk('archivos')->put($nombre_original,  \File::get($archivo) );
       $ruta  =  storage_path('archivos') ."/". $nombre_original;
            if($r1){

                       
            Excel::selectSheetsByIndex(0)->load($ruta, function($hoja) use(&$correcto, &$total){
            $proceso = DB::table('proceso')
                    ->select('id')
                    ->where('activo','=',1)
                    ->get();

            $array = json_decode($proceso); 
            $idproceso="" ;
            foreach($array as $obj){
                $idproceso = $obj->id;                
            }


                $bien = 0;
                $datos = $hoja->get();
                foreach ($datos as $valor){

                    $materia = DB::table('materia')
                                    ->select('id')
                                    ->where('nombre','=',$valor->materia)
                                    ->get();

                    $arrayM = json_decode($materia); 
                    $idmateria="" ;
                    foreach($arrayM as $obj){
                        $idmateria = $obj->id;                
                    }
                    
                    $dificultad = DB::table('dificultad')
                                    ->select('id')
                                    ->where('nombre','=',$valor->dificultad)
                                    ->get();

                    $arrayD = json_decode($dificultad); 
                    $iddificultad="" ;
                    foreach($arrayD as $obj2){
                        $iddificultad = $obj2->id;                
                    }
                    
                    $preguntas = new Preguntas;
                    $preguntas->id_materia= $idmateria;
                    $preguntas->id_dificultad= $iddificultad;
                    $preguntas->pregunta= $valor->pregunta;
                    $preguntas->A1= $valor->alternativa1;
                    $preguntas->A2= $valor->alternativa2;
                    $preguntas->A3= $valor->alternativa3;
                    $preguntas->A4= $valor->alternativa4;
                    $preguntas->A5= $valor->alternativa5;
                    $preguntas->AC= $valor->alternativacorrecta;
                    $preguntas->estado=1;
                    $preguntas->idproceso= $idproceso;
                    
                    $preguntas->save();    
                    $bien ++;
                }
                $existe="NO";
                $correcto = $bien;
                $total = count($datos);
            });  
            return response()->json(['correcto' => $correcto,
                                    'total' => $total,'existe' => $existe]);           
        }
        return response()->json(['correcto' => $correcto,
                                    'total' => $total,'existe' => $existe]);  

        } 
        }

    }
    
    public function indexUsadas()
    {
        //
        $procesos = Proceso::orderBy('id', 'desc')->get();
        $materias = Materia::allactivo();
        $dificultades = Dificultad::allactivo();
        return view('mantenimiento.preguntasusadas')->with('materias', $materias)
                                            ->with('dificultad', $dificultades)
                                            ->with("procesos", $procesos);
    }

    public function listaPreguntasUsadas(Request $request){
        if($request->dato == 0)
            $request->tipo = 0;
        switch ($request->tipo) {
            case 6: #Por Escuela                
                $materia = Preguntas::join('materia as mat','preguntas.id_materia','=','mat.id')
                ->join('dificultad as dif','preguntas.id_dificultad','=','dif.id')
                ->select('preguntas.id as cod','mat.nombre as nombremateria','dif.nombre as nombredificultad','dif.id as iddificultad','mat.id as idmateria','pregunta','A1','A2','A3','A4','A5','AC','preguntas.estado')
                ->where('preguntas.estado','=','0')
                ->where('preguntas.idproceso_usado','=',$request->idproceso)
                ->where('mat.id','=',$request->dato)
                ->get();   
                break;


          
            default:         
            $materia = Preguntas::join('materia as mat','preguntas.id_materia','=','mat.id')
                ->join('dificultad as dif','preguntas.id_dificultad','=','dif.id')
                ->select('preguntas.id as cod','mat.nombre as nombremateria','dif.nombre as nombredificultad','dif.id as iddificultad','mat.id as idmateria','pregunta','A1','A2','A3','A4','A5','AC','preguntas.estado')
                ->where('preguntas.estado','=','0')
                ->where('preguntas.idproceso_usado','=',$request->idproceso)
                ->get();
            break;
        }

      return response()->json(['postulaciones' => $materia]);
    }  

    public function actualizarPreguntasUsadas(Request $request){      
      $pregunta=Preguntas::where('id', '=', $request->codigo)->first();
      if(count($pregunta)>=1){
        $pregunta->id_materia=$request->idmateria;
        $pregunta->id_dificultad=$request->iddificultad;
        $pregunta->pregunta=$request->descripcion;
        $pregunta->A1=$request->a1;
        $pregunta->A2=$request->a2;
        $pregunta->A3=$request->a3;
        $pregunta->A4=$request->a4;
        $pregunta->A5=$request->a5;
        $pregunta->AC=$request->ac;
        $pregunta->save();
      }
    }

}
