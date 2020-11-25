<?php

namespace App;
use App\Postular;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use DB;

class Postulacion extends Model
{
    protected $table = 'postulacion';
    public static function estados()
    {
        $estados = new Estado;
        $estados->incompleto = 0;
        $estados->completo = 1;
        $estados->validado= 2;
        $estados->terminado = 3;
        $estados->anulado = 4;
        return $estados;
    }
    public static function EstadoPostulacion($idPostulante)
    {
        $postulacion = Postulacion::where('idPostulante', '=', $idPostulante)->first();
        return $postulacion->estado;
    } 
    public static function xPostulanteActual($idPostulante)
    {
    	$postulacion = Postulacion::join('proceso', 'postulacion.idproceso', '=', 'proceso.id')
                                    ->where('postulacion.idPostulante', '=', $idPostulante)
                                    ->where('proceso.activo', '=', 1)
                                    ->select("postulacion.*")
                                    ->first();
    	if(!$postulacion) $postulacion = new Postulacion;
    	return $postulacion;
    }

    public static function listaencuesta1()
    {
    	//¿Por qué medio se enteró del proceso de admisión?
    	return json_decode('['.
				    '{"id":"1", "descripcion":"Volantes"},'.
				    '{"id":"2", "descripcion":"Un familiar o amigo"},'.
				    '{"id":"3", "descripcion":"Página Web Institucional"},'.
                    '{"id":"4", "descripcion":"Facebook"},'.
                    '{"id":"5", "descripcion":"Radio"},'.
                    '{"id":"6", "descripcion":"Televisión"},'.
                    '{"id":"7", "descripcion":"Revista"},'.
				    '{"id":"8", "descripcion":"Otro"}'.
				']');
    }

    public static function listaencuesta2()
    {
    	//¿Dónde se preparó para el examen de admisión?
    	return json_decode('['.
				    '{"id":"1", "descripcion":"En mi casa"},'.
				    '{"id":"2", "descripcion":"En el CEPRE - UNAB"},'.
                    '{"id":"3", "descripcion":"En la academia Municipal"},'.
				    '{"id":"4", "descripcion":"En una academia particular"},'.
				    '{"id":"5", "descripcion":"Otro"}'.
				']');
    }
    
    //AGREGADO 17/09/2018
    public static function buscarPostulacion($iduser){
        $proceso = DB::table('proceso')
                    ->select('descripcion','costocarpeta','costoprospecto','id')
                    ->where('activo','=',1)
                    ->get();

        $array = json_decode($proceso); 
        $idProceso="";
        foreach($array as $obj){
            $idProceso = $obj->id;
        }

        $users = DB::table('users')
                        ->select('users.dni')
                        ->where('users.id','=',$iduser)
                        ->get();

        $arrayU = json_decode($users); 
        $dniU="";
        foreach($arrayU as $obj2){
            $dniU = $obj2->dni;
        }


        $postulacion = DB::table('postulacion')
                        ->select('users.id','users.dni')
                        ->join('users', 'users.id', '=', 'postulacion.idPostulante')
                        ->where('users.dni','=',$dniU)
                        ->where('postulacion.idproceso','=',$idProceso)
                        ->get();

        $arrayPos = json_decode($postulacion); 
        $idPos="";
        $dniPos="";
        foreach($arrayPos as $obj1){
            $idPos = $obj1->id;
            $dniPos = $obj1->dni;
        }

        


        if($idPos==$iduser){
            //El mismo postulante
            return 0;
        }else{
            if($dniU==$dniPos){
                //Tiene una postulacion $dniU==$dniPos
                return 1;
            }else{
                if($idPos==""){
                    return 0;
                }else{                    
                    //No tiene una postulacion
                    return 0;   
                }
            }        
        }

    }
    
}
