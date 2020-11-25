<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use App\Detailevaluacion;
use App\Detailevaluacionrep;
use App\Evaluacion;
use App\Area;
use App\Proceso;
use Illuminate\Http\RedirectResponse;

use Storage;
use File;
use DB;

class GenerarexaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */



   public function convertir(Request $request){
     $path = $request->file('fileToUpload');
 $data = file_get_contents($path);
 $base64 = 'data:image/png;base64,' . base64_encode($data);
 return  $base64;
   }

     public function lista()
     {

       $evaluacion= DB::table('evaluacions')
                   ->select('*')
                   ->get();
                   	 return view("evaluacionList")
                     ->with('evaluacion', $evaluacion);

     }

    public function index($token)
    {

     $tokenEvaluacion=$token;

      $procesoid= Proceso::activoID();
      $actual= $procesoid;

        $evaluacion= DB::table('evaluacions')
                    ->select('*')
                    ->where('token','=',$tokenEvaluacion)
                    ->get();
      //$evaluacion= Evaluacion::allactivo($tokenEvaluacion);
      $proceso = Proceso::where('activo', '=', 1)->first();





      $areas = Area::allactivo();
      $proceso= Proceso::activo();

                        $evaluacionGo=$evaluacion;

            	 return view("generarexa")
               ->with('evaluacion', $evaluacionGo)
               ->with('areas', $areas)
    					 ->with('proceso', $proceso);





}



            public function actualizarEstado(Request $request)
        { $tokenEvaluacion=$request->input('p_tokenEvaluacion');
          $estado=$request->input('p_estado');
          return  DB::select('update evaluacions set estado = ? where evaluacions.token = ? ', [ $estado,$tokenEvaluacion]);

        }



   public function obtenerPregunta(Request $request)
    {
      $materia=$request->input('p_materia');
 $dificultad=$request->input('p_dificultad');

       $pregunta= DB::select('select * from preguntas where id_materia = ? and id_dificultad = ? ', [ $materia,$dificultad]);
       return $pregunta;

    }
  public function cargarMateria()
    {
       $materia= DB::table('materia')
                    ->select('*')
                    ->get();

       return $materia;

    }
 public function cargarDificultad()
    {
       $materia= DB::table('dificultad')
                    ->select('*')
                    ->get();

       return $materia;

    }

     public function grabarEvaluacion(Request $request)
    {
        $evaluacion= new Evaluacion;
        $evaluacion->id_proceso= $request->input('p_idproceso');
        $evaluacion->id_area= $request->input('p_idarea');
        $evaluacion->nromaterias= $request->input('p_nromateria');
        $evaluacion->nropreguntas= $request->input('p_nropregunta');

        $evaluacion->nromateriasrep= $request->input('p_nromateriarep');
        $evaluacion->nropreguntasrep= $request->input('p_nropreguntarep');
        $evaluacion->token= $request->input('p_mitoken');

        $evaluacion->duracion= $request->input('p_duracion');
        $evaluacion->notamaxima= $request->input('p_notamaxima');
        $evaluacion->notaminima= $request->input('p_notaminima');
        $evaluacion->fecha_evaluacion= $request->input('p_fechaevaluacion');
        $evaluacion->observacion= $request->input('p_observacion');
        $evaluacion->estado= $request->input('p_estado');
        $evaluacion->tipo= $request->input('p_tipo');
  	$evaluacion->save();



    }

         public function grabarDetallerep(Request $request)
    {
        $idevaluacion=$request->input('p_idevaluacion');
        $idpregunta=$request->input('p_idpregunta');
        $detailevaluacion= new Detailevaluacionrep;
        $detailevaluacion->id_evaluacion= $idevaluacion;
        $detailevaluacion->id_pregunta= $idpregunta;
        $detailevaluacion->estado= '1';
        $detailevaluacion->save();


    }


           public function grabarDetalle(Request $request)
    {
        $idevaluacion=$request->input('p_idevaluacion');
        $idpregunta=$request->input('p_idpregunta');
        $detailevaluacion= new Detailevaluacion;
        $detailevaluacion->id_evaluacion= $idevaluacion;
        $detailevaluacion->id_pregunta= $idpregunta;
        $detailevaluacion->estado= '1';
        $detailevaluacion->save();

    }


      public function listaevaluaciones()
       {

           $usuarios =DB::select('select nropreguntas+nropreguntasrep as nropre,e.*,p.descripcion proceso,a.descripcion as area from evaluacions e inner join area a  on e.id_area=a.id inner join proceso p on e.id_proceso=p.id where e.estado <> 0');

          return response()->json(['usuarios' => $usuarios]);

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




}
