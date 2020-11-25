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
use Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Facades\Excel;
use Storage;
use File;
use DB;

class PagosController extends Controller
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

    public function pagosInformacion(){
        if(!Proceso::abierto())
            return redirect("/");

       $proceso = DB::table('proceso')
                    ->select('costocarpeta','costoprospecto')
                    ->where('activo',1)
                    ->get();

        $array = json_decode($proceso); 
        $costocarpeta="" ;
        $costoprospecto="" ;
        foreach($array as $obj){
        $costocarpeta = $obj->costocarpeta;
        $costoprospecto = $obj->costoprospecto;
        }

        $usee = DB::table('users')
                    ->select('dni')
                    ->where('id',Auth::id())
                    ->get();

        $array = json_decode($usee); 
        $dni="" ;
        
        foreach($array as $obj){
        $dni = $obj->dni;
        
        }

        $tarifas = Tarifa::all()->where('estado',1);


       return view("pagosinformacion")->with('costocarpeta', $costocarpeta)
                                      ->with('costoprospecto', $costoprospecto)
                                      ->with('dni', $dni)
                                      ->with('tarifas', $tarifas);
       
    }

    public function cargarPagos(){
        if(!Proceso::abierto())
            return redirect("/");
       return view("cargarpagos");

    }



    public function grabarPago(Request $request){
                  $pagos = new Pagos;

             $proceso = DB::table('proceso')
                    ->select('descripcion')
                    ->where('activo',1)
                    ->get();

        $array = json_decode($proceso); 
        $descripcion="" ;
        foreach($array as $obj){
        $descripcion= $obj->descripcion;
        }



      
            
                    $pagos->codigodeudor=  $request->input('dni');
                    $pagos->fechapago=  $request->input('fechadepago');
                    $pagos->horapago=  $request->input('horadepago');
                    $pagos->observacion=$request->input('slBanco');
                    $pagos->importepagado=  $request->input('importe');
                    $pagos->numerooperacion=  $request->input('nroperacion');




                    $pagos->codigorubro=  "05";
                    $pagos->codigoempresa=  "122";
                    $pagos->codigoservicio=  "01";
                    $pagos->moneda=  "SOLES";
                    $pagos->numerodocumento=  $request->input('dni');
                    $pagos->estado= $descripcion;
                    
                    $pagos->save();  
                    
                    
                    
    }






    public function cargarPagosExcel(Request $request)
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
                    ->select('descripcion')
                    ->where('activo','=',1)
                    ->get();

            $array = json_decode($proceso); 
            $descripcion="" ;
            foreach($array as $obj){
                $descripcion = $obj->descripcion;                
                }

                $bien = 0;
                $datos = $hoja->get();
                foreach ($datos as $valor){
                    
                    $pagos = new Pagos;
                    $pagos->codigorubro= $valor->codigorubro;
                    $pagos->codigoempresa= $valor->codigoempresa;
                    $pagos->codigoservicio= $valor->codigoservicio;
                    $pagos->moneda= $valor->moneda;
                    $pagos->codigodeudor= $valor->codigodeudor;
                    $pagos->numerodocumento= $valor->codigodeudor;
//                    $pagos->numerodocumento= $valor->numerodocumento;
                    $pagos->nombreduedor= $valor->nombreduedor;
                    $pagos->fechapago= $valor->fechapago;
                    $pagos->horapago= $valor->horapago;
                    $pagos->importepagado= $valor->importepagado;
                    $pagos->numerooperacion= $valor->numerooperacion;
                    $pagos->estado=$descripcion;
                    $pagos->observacion='BANCO INTERBANK';
                    
                    $pagos->save();    
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

       
       //return response()->json(['correcto' => $correcto,
                                    //'total' => $total,'existe' => $existe]);
    }
}
