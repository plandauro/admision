<?php

namespace App;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\User;
use DB;
class Pagos extends Model
{

    protected $table = 'pagos';
        
    public static function buscarPago($iduser)
    {
    	$proceso = DB::table('proceso')
    		    //MODIFICADO 10/09/2018 
            //->select('descripcion')
		    ->select('descripcion','costocarpeta','costoprospecto')
                    ->where('activo','=',1)
                    ->get();

        $array1 = json_decode($proceso); 
        $descripcion="" ;
        //AGREGADO 10/09/2018
        $costocarpeta="" ;
        $costoprospecto="" ;
        foreach($array1 as $obj1){
            $descripcion = $obj1->descripcion;      
            $costocarpeta = $obj1->costocarpeta; 
            $costoprospecto = $obj1->costoprospecto;          
        }
        
        $sumacarpetaprospecto=(float)$costocarpeta+(float)$costoprospecto;

    	$dni = DB::table('users')
                    ->select('dni')
                    ->where('id',"=",$iduser)
                    ->get();

        $array = json_decode($dni); 
        $dni1="" ;
        foreach($array as $obj){
        $dni1 = $obj->dni;
		}  
    	$pagos = Pagos::where('numerodocumento', '=', $dni1)
    			 ->where('estado', '=', $descripcion)	->first();
    			 
  
	$importe = DB::table('pagos')
                    ->select('importepagado')
                    ->where('numerodocumento',"=",$dni1)
                    ->where('estado','=',$descripcion)
                    ->get();

        $arrayimporte = json_decode($importe); 
        $dni1importe=0 ;
        foreach($arrayimporte as $obj3){
        $dni1importe+=(float)$obj3->importepagado;

		}  
    			 
       /*if($pagos){
   		if($dni1importe=="10.00"){
    			return "10.00";
    		}else{
    			if($dni1importe=="40.00"){
    			return "40.00";
    			}else{
    				if($dni1importe=="50.00"){
	    			return "50.00";
	    			}
    			}
    		}
    		return $pagos;*/
    	if($pagos){
       		if($dni1importe<$costocarpeta){
        		return "ms1";
        	}else{
        		if($dni1importe>=$costocarpeta && $dni1importe<$costoprospecto){
        			return "ms2";
        		}else{
        			if($dni1importe>=$costoprospecto && $dni1importe<$sumacarpetaprospecto){
    	    			return "ms3";
    	    		}else{
                        if($dni1importe==$sumacarpetaprospecto){
                            return "ms4";
                        }
                    }
        		}
        	}
        		return $pagos;
        }	
    	else
    		return null;

    }
}
