<?php

namespace App\Http\Controllers;
use App\Ubigeo;
use App\FichaSocioeconomica;
use App\Poblacion;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class SisfohController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
     public function index()
    {
        $departamentos = Ubigeo::departamentos();
        $provincias = "";
        $distritos = "";
        $ficha = FichaSocioeconomica::where('iduser', Auth::id())->first();
        //return $ficha;
        if($ficha == "")
            $ficha = new FichaSocioeconomica();
        if($ficha->idubigeo != 0)
        {  
            $provincias = Ubigeo::provincias(substr($ficha->idubigeo, 0,2)."0000");
            $distritos = Ubigeo::distritos(substr($ficha->idubigeo, 0,4)."00");
        }

        $lista = FichaSocioeconomica::listasCombo();
        $tipovia = FichaSocioeconomica::listaTipoVia();
        //  return $provincias;
        return view('sisfoh')->with('lista',  $lista)
                            ->with('tipovia',  $tipovia)
                            ->with('departamentos', $departamentos)
                            ->with('provincias', $provincias)
                            ->with('distritos', $distritos)
                            ->with('ficha', $ficha);
    }

    function getProvincias($iddepartamento)
    {
    	$provincias = Ubigeo::provincias($iddepartamento);
    	return response()->json(array('provincias'=>$provincias));
    }

    function getDistritos($idprovincia)
    {
    	$distritos = Ubigeo::distritos($idprovincia);
    	return response()->json(array('distritos'=>$distritos));
    }

    function saveStep1(Request $request)
    {
        $messages = [
            'iddepartamento.required' => 'Seleccione departamento.',
            'iddepartamento.exists' => 'El departamento seleccionado no es correcto.',
            'idprovincia.required' => 'Seleccione provincia.',
            'idprovincia.exists' => 'La provincia seleccionado no es correcto.',
            'iddistrito.required' => 'Seleccione distrito.',
            'iddistrito.exists' => 'El distrito seleccionado no es correcto.',
            'centropoblado.min' => 'Verifique el nombre del cetro poblado (min 3 caracteres).',
            'tipovia.required' => 'Seleccione un tipo de vía.',
            'nombrevia.required' => 'El nombre de la vía es obligatorio.',
            'nombrevia.min' => 'Verifique el nombre de la vía (min 3 caracteres).',
        ];
        $validator = Validator::make($request->all(), [
            'iddepartamento' => 'required|exists:ubigeo,id',
            'idprovincia' => 'required|exists:ubigeo,id',
            'iddistrito' => 'required|exists:ubigeo,id',
            'centropoblado' => 'min:3|nullable',
            'tipovia' => 'required|integer|between:1,6',
            'nombrevia' => 'required|min:3',
            'numeropuerta' => 'nullable',
            'block' => 'nullable',
            'piso' => 'nullable',
            'interior' => 'nullable',
            'manzana' => 'nullable',
            'lote' => 'nullable',
            'kilometro' => 'nullable',
            'telefono' => 'nullable',
        ], $messages)->validate();
        $ficha = FichaSocioeconomica::where('iduser', Auth::id())->first();
        if(empty($ficha))
            $ficha = new FichaSocioeconomica;
        $ficha->iduser = Auth::id();
        $ficha->idubigeo = $request->iddistrito;
        $ficha->centropoblado = $request->centropoblado;
        $ficha->tipovia = $request->tipovia;
        $ficha->nombrevia = $request->nombrevia;
        $ficha->numeropuerta = $request->numeropuerta;
        $ficha->block = $request->block;
        $ficha->piso = $request->piso;
        $ficha->interior = $request->interior;
        $ficha->manzana = $request->manzana;
        $ficha->lote = $request->lote;
        $ficha->kilometro = $request->kilometro;
        $ficha->telefono = $request->telefono;
        if($ficha->save())
            return response()->json(['success' => true,
                                        'message' => ""]);
    }
    function saveStep2(Request $request)
    {
        $messages = [
            'tipovivienda.between' => 'Seleccione el Tipo de Vivienda',
            'tipovivienda.required' => 'Seleccione el Tipo de Vivienda',
            'tipoviviendaotro.required_if' => 'Especifique el Tipo de Vivienda',

            'suviviendaes.between' => 'Seleccione el tipo de vivienda',
            'suviviendaes.required' => 'Seleccione el Tipo de Vivienda',
            'suviviendaesotro.required_if' => 'Especifique el Tipo de Vivienda',

            'materialparedes.between' => 'Seleccione el Tipo de Vivienda',
            'materialparedes.required' => 'Seleccione el Tipo de Vivienda',
            'materialparedesotro.required_if' => 'Especifique el Tipo de Vivienda',

            'materialtecho.between' => 'Seleccione el Tipo de Vivienda',
            'materialtecho.required' => 'Seleccione el Tipo de Vivienda',
            'materialtechootro.required_if' => 'Especifique el Tipo de Vivienda',

            'materialpiso.between' => 'Seleccione el Tipo de Vivienda',
            'materialpiso.required' => 'Seleccione el Tipo de Vivienda',
            'materialpisootro.required_if' => 'Especifique el Tipo de Vivienda',

            'tipoalumrado.between' => 'Seleccione el Tipo de Vivienda',
            'tipoalumrado.required' => 'Seleccione el Tipo de Vivienda',
            'tipoalumradootro.required_if' => 'Especifique el Tipo de Vivienda',

            'abastecimientoagua.between' => 'Seleccione el Tipo de Vivienda',
            'abastecimientoagua.required' => 'Seleccione el Tipo de Vivienda',
            'abastecimientoaguaotro.required_if' => 'Especifique el Tipo de Vivienda',

            'serviciohigienico.between' => 'Seleccione el Tipo de Vivienda',
            'serviciohigienico.required' => 'Seleccione el Tipo de Vivienda',
            'numberHorasDemoraLlegar.required_if' => 'Registre cuanto demora en llegar.',
        ];
        
        $validator = Validator::make($request->all(), [
            'tipovivienda' => 'required|integer|between:1,8',
            'tipoviviendaotro' => 'required_if:tipovivienda,8',     
            'suviviendaes' => 'required|integer|between:1,7',
            'suviviendaesotro' => 'required_if:suviviendaes,7',  
            'materialparedes' => 'required|integer|between:1,8',
            'materialparedesotro' => 'required_if:materialparedes,8',
            'materialtecho' => 'required|integer|between:1,8',
            'materialtechootro' => 'required_if:materialtecho,8',
            'materialpiso' => 'required|integer|between:1,7',
            'materialpisootro' => 'required_if:materialpiso,7',
            'tipoalumrado' => 'required|integer|between:1,6',
            'tipoalumradootro' => 'required_if:tipoalumrado,5',
            'abastecimientoagua' => 'required|integer|between:1,7',
            'abastecimientoaguaotro' => 'required_if:abastecimientoagua,7',
            'serviciohigienico' => 'required|integer|between:1,6',
            'radioHorasDemoraLlegar' => 'nullable|integer|between:1,2',
            'numberHorasDemoraLlegar' => 'required_if:radioHorasDemoraLlegar,'
        ], $messages)->validate();

        $ficha = FichaSocioeconomica::where('iduser', Auth::id())->first();
        $ficha->tipovivienda = $request->tipovivienda;
        $ficha->tipoviviendaotro = $request->tipoviviendaotro;
        $ficha->suviviendaes = $request->suviviendaes;
        $ficha->suviviendaesotro = $request->suviviendaesotro;
        $ficha->materialparedes = $request->materialparedes;
        $ficha->materialparedesotro = $request->materialparedesotro;
        $ficha->materialtecho = $request->materialtecho;
        $ficha->materialtechootro = $request->materialtechootro;
        $ficha->materialpiso = $request->materialpiso;
        $ficha->materialpisootro = $request->materialpisootro;
        $ficha->tipoalumrado = $request->tipoalumrado;
        $ficha->tipoalumradootro = $request->tipoalumradootro;
        $ficha->abastecimientoagua = $request->abastecimientoagua;
        $ficha->abastecimientoaguaotro = $request->abastecimientoaguaotro;
        $ficha->serviciohigienico = $request->serviciohigienico;
        $ficha->demorallegar = $request->radioHorasDemoraLlegar;
        $ficha->demorallegarhoras = $request->numberHorasDemoraLlegar;
        //return $ficha;
        if($ficha->save())
            return response()->json(['success' => true,
                                        'message' => ""]);
    }
    function saveStep3(Request $request)
    {
        $messages = [
            'cantidadhabitaciones.required' => 'Ingrese la cantidad de habitaciones que ocupa su hogar.',
            'cantidadhabitaciones.between' => 'Asegurese ingresar una cantidad correcta de habitaciones.',
            'combustible.required' => 'Seleccione el combustible que usa en el hogar para cocinar.',
            'combustibleotro.required_if' => 'Especifique el combustible que usa para cocinar.',
            'cantidadhombres.required' => 'Ingrese la cantidad de hombres que integran su hogar.',
            'cantidadmujeres.required' => 'Ingrese la cantidad de mujeres que integran su hogar.',
            'cantidadhombres.between' => 'Ingrese una cantidad correcta de hombres que integran su hogar.',
            'cantidadmujeres.between' => 'Ingrese una cantidad correcta de mujeres que integran su hogar.',
            'totalpersonas.required' => 'Verifique la cantidad de personas que viven en su hogar.'
        ];
        $validator = Validator::make($request->all(), [
            'cantidadhabitaciones' => 'required|integer|between:1,100',
            'combustible' => 'required|between:1,8',
            'combustibleotro' => 'required_if:combustible,7',
            'equiposonido' => 'nullable|between:0,1',
            'televisorcolor' => 'nullable|between:0,1',
            'dvd' => 'nullable|between:0,1',
            'licuadora' => 'nullable|between:0,1',
            'refrigeradora' => 'nullable|between:0,1',
            'cocinagas' => 'nullable|between:0,1',
            'telefonofijo' => 'nullable|between:0,1',
            'planchaelectrica' => 'nullable|between:0,1',
            'lavadora' => 'nullable|between:0,1',
            'computadora' => 'nullable|between:0,1',
            'hornomicroondas' => 'nullable|between:0,1',
            'internet' => 'nullable|between:0,1',
            'cable' => 'nullable|between:0,1',
            'celular' => 'nullable|between:0,1',
            'cantidadhombres' => 'required|integer',
            'cantidadmujeres' => 'required|integer',
        ], $messages)->validate();
        if($request->cantidadhombres + $request->cantidadmujeres < 1)
            return response()->json(['totalpersonas' => 'Verifique la cantidad de personas que viven en su hogar.'], 422);

        $ficha = FichaSocioeconomica::where('iduser', Auth::id())->first();
        $ficha->cantidadhabitaciones = $request->cantidadhabitaciones;
        $ficha->combustible = $request->combustible;
        $ficha->combustibleotro = $request->combustibleotro;
        $ficha->equiposonido = $request->equiposonido;
        $ficha->televisorcolor = $request->televisorcolor;
        $ficha->dvd = $request->dvd;
        $ficha->licuadora = $request->licuadora;
        $ficha->refrigeradora = $request->refrigeradora;
        $ficha->cocinagas = $request->cocinagas;
        $ficha->telefonofijo = $request->telefonofijo;
        $ficha->planchaelectrica = $request->planchaelectrica;
        $ficha->lavadora = $request->lavadora;
        $ficha->computadora = $request->computadora;
        $ficha->hornomicroondas = $request->hornomicroondas;
        $ficha->internet = $request->internet;
        $ficha->cable = $request->cable;
        $ficha->celular = $request->celular;
        $ficha->cantidadhombres = $request->cantidadhombres;
        $ficha->cantidadmujeres = $request->cantidadmujeres;

        $msg = "";
        //return response()->json($this->cargarInformantePoblacion($ficha->id));
        if($ficha->save())
        {
            $msg = "Inserción correcta.</b>";
            if($this->cargarInformantePoblacion($ficha->id))
                $msg = $msg. "Usuario registrado en población satisfactoriamente.";
            return response()->json(['success' => true,
                                        'message' => $msg]);
        }
    }
    function saveStep4(Request $request)
    {
        $ficha = FichaSocioeconomica::where('iduser', Auth::id())->first();
        $persona = Poblacion::where('idfichasocioeconomica', $ficha->id)
                                ->where('informante', 1)->first();

        return $this->verificarCompletoPersona($persona); 

        if(!$this->verificarCompletoPersona($persona))
            return response()->json(['success' => false,
                                        'message' => Auth::user()->nombre." asegúrate de haber completado todos tus datos."], 422);

        return response()->json(['success' => true,
                                    'message' => "Registro de la población satisfactorio."]);
        
    }
    private function cargarInformantePoblacion($idFicha)
    {
        $informantepoblacion = Poblacion::where('idfichasocioeconomica', $idFicha)->where('informante', 1)->first();
        //return $informantepoblacion;
        if(!$informantepoblacion == "")
            return true;
        $informantepoblacion = new Poblacion;
        $informantepoblacion->idfichasocioeconomica = $idFicha;
        $informantepoblacion->informante = 1;
        $informantepoblacion->apepaterno = Auth()->user()->apepaterno;
        $informantepoblacion->apematerno = Auth()->user()->apematerno;
        $informantepoblacion->nombres = Auth()->user()->nombre;
        $informantepoblacion->fechanacimiento = Auth()->user()->fechanacimiento;
        $informantepoblacion->tipodocumento = 1;
        $informantepoblacion->numerodocumento = Auth()->user()->dni;
        $informantepoblacion->sexo = Auth()->user()->sexo;
        if($informantepoblacion->save()) return true;
        else return false;
    }
    private function verificarCompletoPersona($persona)
    {
        $poblacion = new Poblacion;
        $validator = Validator::make($persona, $poblacion->rules, $poblacion->messages)->validate();
    }
}
