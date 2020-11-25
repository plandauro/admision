<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Ubigeo;
use App\Postulacion;
use App\InstitucionEducativa;
use App\Tarifa;
use App\Escuela;
use App\Proceso;
use App\Ambiente;
use PDF;
use DB;
use WKPDF;


class PDFController extends Controller
{
    public function fichaInscripcion($idpostulante = null)
    {
        if($idpostulante == null)
            $idpostulante = Auth::id();
        else if (!(Auth::user()->isAsistente() || Auth::user()->isCoordinador()))
            return "Acceso Denegado";
        if(Postulacion::EstadoPostulacion($idpostulante) == Postulacion::estados()->incompleto)
            return "Archivo no disponible. Asegúrese de haber completado correctamente todo el formulario de Postulación.";

        $postulante = User::find($idpostulante);

       

        if($postulante->extranjero != 1){
           $postulante->ubigeonacimiento = Ubigeo::find($postulante->idubigeonacimiento);
        }
        $postulante->ubigeodireccion = Ubigeo::find($postulante->idubigeodireccion);
        $postulante->edad = User::getEdad($postulante->fechanacimiento);
        
        if($postulante->colegioextranjero!=1 && $postulante->isotrainstitucion != 1){
            $postulante->colegio = InstitucionEducativa::find($postulante->idinstitucioneducativa);
        }
        if($postulante->idubigeocolegio != null){
            $postulante->ubigeocolegio = Ubigeo::find($postulante->idubigeocolegio);
        }
        
        //$postulacion = Postulacion::where('postulacion.idPostulante', '=', $idpostulante)->first();
        
        $proceso2 = DB::table('proceso')
                        ->select('id')
                        ->where('activo','=',1)
                        ->get();
    
            $array3 = json_decode($proceso2); 
            $id="" ;
            foreach($array3 as $obj2){
                $id= $obj2->id;                
    }
        
        $postulacion = Postulacion::where('postulacion.idPostulante', '=', $idpostulante)
                        ->where('postulacion.idproceso', '=', $id)
                        ->first();

        
        $postulacion->tarifa = Tarifa::find($postulacion->idtarifa);
        $postulacion->escuela = Escuela::find($postulacion->idescuela);
//        $postulacion->proceso = Proceso::find($postulacion->idproceso)->descripcion;

    $proceso = DB::table('proceso')
                        ->select('descripcion')
                        ->where('activo','=',1)
                        ->get();
    
            $array1 = json_decode($proceso); 
            $descripcion="" ;
            foreach($array1 as $obj1){
                $descripcion = $obj1->descripcion;                
    }
     
        $postulacion->proceso = $descripcion;
        $data =[
            'postulacion' => $postulacion,
            'postulante' => $postulante
        ];
        $pdf = PDF::loadView('pdf.inscripcion',  ['data' => $data]);
        return $pdf->download('fichaInscripcion-'.Postulacion::xPostulanteActual($idpostulante)->id.'.pdf');
    }

    public function carneInscripcion($idpostulante = null)
    {
        if($idpostulante == null)
            $idpostulante = Auth::id();
        else if (!(Auth::user()->isAsistente() || Auth::user()->isCoordinador()))
            return "Acceso Denegado";
        if(Postulacion::EstadoPostulacion($idpostulante) == Postulacion::estados()->incompleto)
            return "Archivo no disponible. Asegúrese de haber completado correctamente todo el formulario de Postulación.";

        $postulante = User::find($idpostulante);
//        $postulacion = Postulacion::where('postulacion.idPostulante', '=', $idpostulante)->first();        
        $proceso2 = DB::table('proceso')
                        ->select('id')
                        ->where('activo','=',1)
                        ->get();
    
            $array3 = json_decode($proceso2); 
            $id="" ;
            foreach($array3 as $obj2){
                $id= $obj2->id;                
    }
        $postulacion = Postulacion::where('postulacion.idPostulante', '=', $idpostulante)
                        ->where('postulacion.idproceso', '=', $id)
                        ->first();
                        
        $postulacion->modalidad =  Tarifa::find($postulacion->idtarifa)->descripcion;
        $postulacion->escuela =  Escuela::find($postulacion->idescuela)->descripcion;
        $ambiente = Ambiente::find($postulacion->idambiente);
        $data =[
            'postulacion' => $postulacion,
            'postulante' => $postulante,
            'ambiente' => $ambiente,
        ];
        $pdf = PDF::loadView('pdf.carnepostulanteinscripcion',  ['data' => $data]);
        return $pdf->download('carnepostulanteinscripcion-'.Postulacion::xPostulanteActual($idpostulante)->id.'.pdf');
    }

    public function djantecedentesInscripcion($idpostulante = null)
    {
        if($idpostulante == null)
            $idpostulante = Auth::id();
        else if (!(Auth::user()->isAsistente() || Auth::user()->isCoordinador()))
            return "Acceso Denegado";
        if(Postulacion::EstadoPostulacion($idpostulante) == Postulacion::estados()->incompleto)
            return "Archivo no disponible. Asegúrese de haber completado correctamente todo el formulario de Postulación.";
        $postulante = User::find($idpostulante);
//        $postulacion = Postulacion::where('postulacion.idPostulante', '=', $idpostulante)->first();;

        $proceso2 = DB::table('proceso')
                        ->select('id')
                        ->where('activo','=',1)
                        ->get();
    
            $array3 = json_decode($proceso2); 
            $id="" ;
            foreach($array3 as $obj2){
                $id= $obj2->id;                
    }
        $postulacion = Postulacion::where('postulacion.idPostulante', '=', $idpostulante)
                        ->where('postulacion.idproceso', '=', $id)
                        ->first();
                        
        //$postulacion->proceso = Proceso::find($postulacion->idproceso);
        $postulacion->proceso = Proceso::find($postulacion->idproceso);
        $data =[
            'postulacion' => $postulacion,
            'postulante' => $postulante
        ];
        $pdf =  PDF::loadView('pdf.djantecedentespenales',  ['data' => $data]);
        return $pdf->download('djantecedentespenales-'.Postulacion::xPostulanteActual($idpostulante)->id.'.pdf');
    }

    public function constancias($idproceso, $idescuela)
    {
        $escuela = Escuela::find($idescuela);
        if(!$escuela)
            return "ERROR: La escuela solicitadad no existe";
        $postulaciones = Postulacion::join('users', 'postulacion.idpostulante', '=', 'users.id')
                        ->join('escuela', 'postulacion.idescuela', '=', 'escuela.id')
                        ->join('tarifa', 'postulacion.idtarifa', '=', 'tarifa.id')
                        ->join('modalidad', 'tarifa.idmodalidad', '=', 'modalidad.id')
                        ->join('proceso', 'postulacion.idproceso', '=', 'proceso.id')
                        ->select('postulacion.codalumno', 
                                DB::raw('CONCAT(users.apepaterno, " ", users.apematerno) as apellidos'),
                                'users.nombre', 'users.dni', 'users.foto','escuela.descripcion as escuela',
                                'modalidad.descripcion as modalidad', 'postulacion.puntaje', 
                                'postulacion.omg', 'postulacion.ome', 'proceso.resolucion', 'proceso.responsable', 'proceso.descripcion as proceso','postulacion.nroPostulante'
                                ,'proceso.descripcion')
                        ->whereIn('postulacion.estado', [2,3])
                        ->where('resultado', 'INGRESO')
                        ->where('postulacion.idproceso', $idproceso)
                        ->where('idescuela', $escuela->id)
                        ->orderBy('apellidos', 'asc')
                        ->get();
        $data =[
            'postulaciones' => $postulaciones,
        ];

        $pdf =  PDF::loadView('pdf.constancias',  ['data' => $data]);
        return $pdf->download('constancias-'.$escuela->descripcion.'.pdf');
    }
    
    public function calificacioncepre()
    {
        
    //$postulaciones=DB :: statement('call sp_calificar_cepre()');
        //$postulaciones=(DB :: select( DB :: raw ("call sp_calificar_cepre()")));
        //$postulaciones=json_decode($postulacionesx);
        $postulaciones=DB::select('select id from pagos');
        //$postulaciones=json_encode($postulacionesx);
    $x=(array)$postulaciones;
    $array = json_decode(json_encode($postulaciones), True);
        $pdf =  PDF::loadView('pdf.reportecalificacioncepre',  ['postulaciones' => $array]);
        return $pdf->download('constanciasX.pdf');
    }
    
    public function calificacionadmision($idproceso, $idescuela)
    {
        $escuela = Escuela::find($idescuela);
        if(!$escuela)
            return "ERROR: La escuela solicitadad no existe";
        $postulaciones=(DB :: select( DB :: raw ("call sp_calificar_simulacro()")));
        $data =[
            'postulaciones' => $postulaciones,
        ];

        $pdf =  PDF::loadView('pdf.constancias',  ['data' => $data]);
        return $pdf->download('constancias-'.$escuela->descripcion.'.pdf');
    }
    
    public function padron($idproceso, $idescuela)
    {
        $escuela = Escuela::find($idescuela);
        if(!$escuela)
            return "ERROR: La escuela solicitadad no existe";
        $postulaciones = Postulacion::join('users', 'postulacion.idpostulante', '=', 'users.id')
                        ->join('escuela', 'postulacion.idescuela', '=', 'escuela.id')
                        ->join('tarifa', 'postulacion.idtarifa', '=', 'tarifa.id')
                        ->join('modalidad', 'tarifa.idmodalidad', '=', 'modalidad.id')
                        ->join('proceso', 'postulacion.idproceso', '=', 'proceso.id')
                        ->select('postulacion.codalumno', 
                                DB::raw('CONCAT(users.apepaterno, " ", users.apematerno) as apellidos'),
                                'users.nombre', 'users.dni', 'users.foto','escuela.descripcion as escuela',
                                'modalidad.descripcion as modalidad', 'postulacion.puntaje', 
                                'postulacion.omg', 'postulacion.ome', 'proceso.resolucion', 'proceso.responsable', 'proceso.descripcion as proceso','postulacion.nroPostulante')
                        ->whereIn('postulacion.estado', [2,3])
                        ->where('resultado', 'INGRESO')
                        ->where('postulacion.idproceso', $idproceso)
                        ->where('idescuela', $escuela->id)
                        ->orderBy('apellidos', 'asc')
                        ->get();
        $data =[
            'postulaciones' => $postulaciones,
        ];

        $pdf =  PDF::loadView('pdf.padron',  ['data' => $data]);
        return $pdf->download('padron-'.$escuela->descripcion.'.pdf');
    }
    
    public function padronpostulantes($idproceso, $idambiente)
    {
        $ambiente = Ambiente::find($idambiente);
    $proceso2 = DB::table('proceso')
                            ->select('id')
                            ->where('activo','=',1)
                            ->get();
        
                $array3 = json_decode($proceso2); 
                $id="" ;
                foreach($array3 as $obj2){
                    $id= $obj2->id;                
    }

        if(!$ambiente)
            return "ERROR: La escuela solicitadad no existe";
        $postulaciones = Postulacion::join('users', 'postulacion.idpostulante', '=', 'users.id')
                        ->join('ambiente', 'postulacion.idambiente', '=', 'ambiente.id')
                        ->join('escuela', 'postulacion.idescuela', '=', 'escuela.id')
                        ->join('tarifa', 'postulacion.idtarifa', '=', 'tarifa.id')
                        ->join('modalidad', 'tarifa.idmodalidad', '=', 'modalidad.id')
                        ->join('proceso', 'postulacion.idproceso', '=', 'proceso.id')
                        ->select('postulacion.id as codalumno', 
                                DB::raw('CONCAT(users.apepaterno, " ", users.apematerno) as apellidos'),
                                'users.nombre', 'users.dni', 'users.foto','escuela.descripcion as escuela','ambiente.descripcion as ambiente',
                                'modalidad.descripcion as modalidad', 'postulacion.puntaje', 
                                'postulacion.omg', 'postulacion.ome', 'proceso.resolucion', 'proceso.responsable', 'proceso.descripcion as proceso','postulacion.nroPostulante')
                        ->whereIn('postulacion.estado', [2,3])
                        //->where('resultado', 'INGRESO')
                        //->where('idambiente', $ambiente->id)
                        ->where('idambiente', $ambiente->id)
                        ->where('idproceso', $id)
                        ->orderBy('apepaterno', 'asc')
                        //->orderBy('apematerno', 'asc')
                        ->get();
        $data =[
            'postulaciones' => $postulaciones,
        ];

        $pdf =  PDF::loadView('pdf.padronpostulantes',  ['data' => $data]);
        return $pdf->download('padron-ambiente-'.$ambiente->descripcion.'.pdf');
    }
    
    
    
   
   
       public function calificacionsimulacro()
    {
        
    //$postulaciones=DB :: statement('call sp_calificar_cepre()');
        //$postulaciones=(DB :: select( DB :: raw ("call sp_calificar_cepre()")));
        //$postulaciones=json_decode($postulacionesx);
        //$postulaciones=DB::select('select id from pagos');
        //$postulaciones=json_encode($postulacionesx);
    //$x=(array)$postulaciones;

      //  $postulaciones=(DB :: select( DB :: raw ("call sp_calificar_simulacro()")));
       // $data =[            'postulaciones' => $postulaciones        ];

    $calificacion=(DB :: select( DB :: raw ("call sp_calificar_simulacro()")));
        $data =[
            'calificacion' => $calificacion
        ];
                    

        
        $pdf =  PDF::loadView('pdf.reportecalificacionsimulacro',  ['data' => $data]);
        return $pdf->download('constanciasX.pdf');
    }
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
    
        public function examenAdmision()
    {
        return view('examenadmi');
    }
    
    

    public function examenAdmisionTONE($idevaluacion)
{

  $evaluacion= DB::select('select a.descripcion as area, a.nombre as areanombre,p.descripcion,e.* FROM evaluacions e inner join proceso p on e.id_proceso=p.id inner join area a on e.id_area=a.id where token = ? ', [$idevaluacion]);


  $materias= DB::select('select m.id,m.nombre AS Materia from preguntas p inner join
detailevaluacions d on d.id_pregunta=p.id inner join evaluacions ev on d.id_evaluacion=ev.id
inner join materia m on p.id_materia=m.id where token
 = ? group by m.id,m.nombre
UNION
select m.id,m.nombre AS Materia from preguntas p inner join
detailevaluacionreps d on d.id_pregunta=p.id inner join evaluacions ev on d.id_evaluacion=ev.id
inner join materia m on p.id_materia=m.id where token
 = ? group by m.id,m.nombre ', [$idevaluacion,$idevaluacion]);

   $preguntas= DB::select('select img,id_materia,LENGTH(pregunta) AS Len, @rowname:=@rowname+1 AS POSICION,p.id,pregunta,A1,A2,A3,A4,A5
from (SELECT @rowname:=0)r,preguntas p inner join  detailevaluacions d on d.id_pregunta=p.id
inner join evaluacions ev on d.id_evaluacion=ev.id where token = ?
UNION
select img,id_materia,LENGTH(pregunta) AS Len, @rowname:=@rowname+1 AS POSICION,p.id,pregunta,A1,A2,A3,A4,A5
from (SELECT @rowname:=0)r,preguntas p inner join  detailevaluacionreps d on d.id_pregunta=p.id
inner join evaluacions ev on d.id_evaluacion=ev.id where token = ? order by  len
', [$idevaluacion,$idevaluacion]);


 $data =[
   'materias' => $materias,
   'evaluacion' => $evaluacion,
    'preguntas' => $preguntas

    ];

  $pdf = PDF::loadView('pdf.examen',  ['data' => $data]);
  return $pdf->download('examenAdm.pdf');
}


            public function examenAdmisionTTWO($idevaluacion,$idproceso)
        {

  $evaluacion= DB::select('select a.descripcion as area, a.nombre as areanombre,p.descripcion,e.* FROM evaluacions e inner join proceso p on e.id_proceso=p.id inner join area a on e.id_area=a.id where token = ? ', [$idevaluacion]);



        $preguntas= DB::select('select img,id_materia,LENGTH(pregunta) AS Len, @rowname:=@rowname+1 AS POSICION,p.id,pregunta,A1,A2,A3,A4,A5
from (SELECT @rowname:=0)r,preguntas p inner join  detailevaluacions d on d.id_pregunta=p.id
inner join evaluacions ev on d.id_evaluacion=ev.id where token = ?
UNION
select img,id_materia,LENGTH(pregunta) AS Len, @rowname:=@rowname+1 AS POSICION,p.id,pregunta,A1,A2,A3,A4,A5
from (SELECT @rowname:=0)r,preguntas p inner join  detailevaluacionreps d on d.id_pregunta=p.id
inner join evaluacions ev on d.id_evaluacion=ev.id  where ev.id_proceso = ? order by  len', [$idevaluacion,$idproceso]);



  $materias= DB::select('
select m.id,m.nombre AS Materia from preguntas p inner join
detailevaluacions d on d.id_pregunta=p.id inner join evaluacions ev on d.id_evaluacion=ev.id
inner join materia m on p.id_materia=m.id where token
 = ? group by m.id,m.nombre
UNION
select m.id,m.nombre AS Materia from preguntas p inner join
detailevaluacionreps d on d.id_pregunta=p.id inner join evaluacions ev on d.id_evaluacion=ev.id
inner join materia m on p.id_materia=m.id where ev.id_proceso
 = ? group by m.id,m.nombre ', [$idevaluacion,$idproceso]);





         $data =[
   'materias' => $materias,
   'evaluacion' => $evaluacion,
    'preguntas' => $preguntas

    ];


            $pdf = PDF::loadView('pdf.examen',  ['data' => $data]);
            return $pdf->download('examenAdm.pdf');
        }


                    public function examenAdmisionTTREE($idevaluacion,$idproceso)
                {


            
           
             $evaluacion= DB::select('select a.descripcion as area, a.nombre as areanombre,p.descripcion,e.* FROM evaluacions e inner join proceso p on e.id_proceso=p.id inner join area a on e.id_area=a.id where token = ? ', [$idevaluacion]);



        $preguntas= DB::select('select img,id_materia,LENGTH(pregunta) AS Len, @rowname:=@rowname+1 AS POSICION,p.id,pregunta,A1,A2,A3,A4,A5
from (SELECT @rowname:=0)r,preguntas p inner join  detailevaluacionreps d on d.id_pregunta=p.id
inner join evaluacions ev on d.id_evaluacion=ev.id  where ev.id_proceso = ? order by  len', [$idproceso]);



  $materias= DB::select('select m.id,m.nombre AS Materia from preguntas p inner join
detailevaluacionreps d on d.id_pregunta=p.id inner join evaluacions ev on d.id_evaluacion=ev.id
inner join materia m on p.id_materia=m.id where ev.id_proceso  = ? group by m.id,m.nombre ', [$idproceso]);
          
                    $data =[  'materias' => $materias,
                'evaluacion' => $evaluacion,
                    'preguntas' => $preguntas];





                    $pdf = PDF::loadView('pdf.examen',  ['data' => $data]);


                    return $pdf->download('examenAdm.pdf');
                }
                
                
                
                
                
                
                


                public function examenAdmisionTFOUR($idevaluacion)
            {
           
             $evaluacion= DB::select('select a.descripcion as area, a.nombre as areanombre,p.descripcion,e.* FROM evaluacions e inner join proceso p on e.id_proceso=p.id inner join area a on e.id_area=a.id where token = ? ', [$idevaluacion]);



        $preguntas= DB::select('select img,id_materia,LENGTH(pregunta) AS Len, @rowname:=@rowname+1 AS POSICION,p.id,pregunta,A1,A2,A3,A4,A5
from (SELECT @rowname:=0)r,preguntas p inner join  detailevaluacions d on d.id_pregunta=p.id
inner join evaluacions ev on d.id_evaluacion=ev.id  where token = ? order by  len', [$idevaluacion]);



  $materias= DB::select('select m.id,m.nombre AS Materia from preguntas p inner join
detailevaluacions d on d.id_pregunta=p.id inner join evaluacions ev on d.id_evaluacion=ev.id
inner join materia m on p.id_materia=m.id where token  = ? group by m.id,m.nombre ', [$idevaluacion]);
          
                    $data =[  'materias' => $materias,
                'evaluacion' => $evaluacion,
                    'preguntas' => $preguntas];

                  $pdf = PDF::loadView('pdf.examen',  ['data' => $data]);
              return $pdf->download('examenAdm.pdf');
           //  return WKPDF::loadFile('https://admision.unab.edu.pe/examenAdmision/1')->inline('github.pdf');

            }

    
    
}