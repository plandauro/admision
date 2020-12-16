<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use DB;
use App\MD_ADM005;
use Illuminate\Support\Facades\Auth;

class CT_ADM005 extends Controller
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

    /* SIRVE PARA CONTROLAR LISTAR TODOS LOS USUARIOS DE ADMISION */
    public function index(){
        $estados = (DB :: select( DB :: raw ("CALL P_LIS_SIS_PARAMETROS_DETALLE(1)")));
        $parametros = (DB :: select( DB :: raw ("CALL P_LIS_ADM_PARAMETROS()")));
        $parametrosdetalle = (DB :: select( DB :: raw ("CALL P_LIS_ADM_PARAMETROS_DETALLE()")));
        $proceso = (DB :: select( DB :: raw ("CALL P_OBT_ADM_PROCESO(1)")));
        $escuela = (DB :: select( DB :: raw ("CALL P_LIS_ADM_ESCUELA")));
        $ambiente = (DB :: select( DB :: raw ("CALL P_LIS_ADM_AMBIENTE")));
        $cantidad = (DB :: select( DB :: raw ("CALL P_OBT_ADM_AULA_SIMULACRO")));
        $cantidadM='';
        foreach($cantidad as $obj){
            $cantidadM = $obj->MENSAJE;
        }
        return view('configuracion.VB_ADM005')->with('estados', $estados)->with('parametros', $parametros)->with('parametrosdetalle', $parametrosdetalle)->with('proceso', $proceso)->with('escuela', $escuela)->with('ambiente', $ambiente)->with('cantidad', $cantidadM);
    }

    public function listaPostulanteSimulacro(Request $request){
      $postulanteSimulacro = (DB :: select( DB :: raw ("CALL P_LIS_ADM_POSTULANTE_SIMULACRO()")));
      return response()->json(['data' => $postulanteSimulacro]);
    }

    public function crearPostulanteSimulacro(Request $request){
        $txtproceso=$request->txtproceso;
        $txtescuela=$request->txtescuela;
        $txtambiente=$request->txtambiente;
        $txtapellidosynombres=$request->txtapellidosynombres;
        $txtdni=$request->txtdni;
        $txtfechapago=$request->txtfechapago;
        $txtopvoucher=$request->txtopvoucher;
        $txtcelular=$request->txtcelular;
        $txtestado=1;
        $USUARIO = Auth::id();
        $consultardni=(DB :: select( DB :: raw ("CALL P_OBT_ADM_POSTULANTE_DNI($txtdni)")));
        $dni_existe='';
        foreach($consultardni as $obj){
            $dni_existe = $obj->N_REGISTRO;
        }
        if($dni_existe == 0){
            DB :: statement("call P_INS_ADM_POSTULANTE_SIMULACRO($txtproceso,$txtescuela,$txtambiente,'$txtapellidosynombres','$txtdni','$txtfechapago','$txtopvoucher','$txtcelular','$txtestado','$USUARIO')");
            $msg = 'Se registro correctamente el Postulante';
            return response()->json(['success' => true,'message' => $msg]);
        }
        else{
            $msg = 'Ya existe este DNI registrado para el Simulacro de Examen';
            return response()->json(['success' => false,'message' => $msg]);
        }

    }

    public function actualizarPostulanteSimulacro(Request $request){
        $txtcodigo=$request->txtcodigo;
        $txtproceso=$request->txtproceso;
        $txtescuela=$request->txtescuela;
        $txtambiente=$request->txtambiente;
        $txtapellidosynombres=$request->txtapellidosynombres;
        $txtdni=$request->txtdni;
        $txtfechapago=$request->txtfechapago;
        $txtopvoucher=$request->txtopvoucher;
        $txtcelular=$request->txtcelular;
        $txtestado=1;
        $USUARIO = Auth::id();
        DB :: statement("call P_ACT_ADM_POSTULANTE_SIMULACRO($txtcodigo,$txtproceso,$txtescuela,$txtambiente,'$txtapellidosynombres','$txtdni','$txtfechapago','$txtopvoucher','$txtcelular','$txtestado','$USUARIO')");
        $msg = $request->txtcodigo;
        return response()->json(['success' => false,'message' => $msg]);
    }

    public function eliminarPostulanteSimulacro(Request $request){ 
        $txtcodigo=$request->txtcodigo;  
        $txtproceso=$request->txtproceso;   
        $USUARIO = Auth::id();
        DB :: statement("call P_ELI_ADM_POSTULANTE_SIMULACRO($txtcodigo,$txtproceso,'$USUARIO')");
        $msg = 'Se elimino correctamente el Postulante';
        return response()->json(['success' => true,'message' => $msg]);
    }   
}
