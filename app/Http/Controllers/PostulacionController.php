<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use App\Ubigeo;
use App\InstitucionEducativa;
use App\Postulacion;
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
use Maatwebsite\Excel\Facades\Excel;
use DB;
//use App\Http\Controllers\class.phpmailer.php;


class PostulacionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $postulacion = Postulacion::xPostulanteActual(Auth::id());
        $proceso = Proceso::abierto();
        //Si no hay proceso abierto, entonces redireccionar al inicio
        if (!$proceso)
            return redirect('/');

        switch ($postulacion->estado) {
            case 0:
                return PostulacionController::indexPostulacionNueva();
                break;
            case 1:
                return PostulacionController::indexPostulacionCompleta();
                break;
            case 2:
                return PostulacionController::indexVerificado();
                break;
            default:
                return redirect('/');
                break;
        }
    }
    public function indexverificar($value = '')
    {
        if (!Proceso::abierto())
            return redirect("/");
        $departamentos = Ubigeo::departamentos();
        $tarifas = Tarifa::allactivo();
        $escuelas = Escuela::allactivo();

        //AGREGADO 07/09/2018
        $encuesta1 = Postulacion::listaencuesta1();
        $encuesta2 = Postulacion::listaencuesta2();

        return view('verificarpostulacion')->with('departamentos', $departamentos)
            ->with('tarifas', $tarifas)
            //AGREGADO 07/08/2018
            ->with('encuesta1', $encuesta1)
            ->with('encuesta2', $encuesta2)
            ->with('escuelas', $escuelas);
    }
    public function indexPostulacionCompleta()
    {
        $postulacion = Postulacion::xPostulanteActual(Auth::id());
        $postulacion->tarifa = Tarifa::find($postulacion->idtarifa);
        $proceso = Proceso::find($postulacion->idproceso);
        $postulante = Auth::user();
        $postulante->edad = User::getEdad($postulante->fechanacimiento);
        $ubicacion = DB::table('users')
            ->select('ubigeo.provincia')
            ->join('ubigeo', 'ubigeo.id', '=', 'users.idubigeodireccion')
            ->where('users.id', '=', Auth::id())
            ->where('ubigeo.departamento', '=', 'Lima')
            ->where('ubigeo.provincia', '=', 'barranca')
            ->get();
        $array = json_decode($ubicacion);
        $ubicacionX = "";
        foreach ($array as $obj) {
            $ubicacionX = $obj->provincia;
        }

        //AGREGADO 11/09/2018 -- ->with('tarifa', $postulacion->idtarifa)
        return view('postulacioncompleta')->with('postulacion', $postulacion)
            ->with('costocarpeta', $proceso->costocarpeta)
            ->with('costoprospecto', $proceso->costoprospecto)
            ->with('postulante', $postulante)
            ->with('tarifa', $postulacion->idtarifa)
            ->with('ubicacion', trim($ubicacionX));
    }
    public function indexPostulacionNueva()
    {
        $departamentos = Ubigeo::departamentos();
        $provinciasdireccion = "";
        $distritosdireccion = "";
        $provinciasnacimiento = "";
        $distritosnacimiento = "";
        $provinciascolegio = "";
        $distritoscolegio = "";
        $colegios = "";
        $tarifas = Tarifa::allactivo();
        $escuelas = Escuela::allactivo();
        $postulacion = Postulacion::xPostulanteActual(Auth::id());
        $encuesta1 = Postulacion::listaencuesta1();
        $encuesta2 = Postulacion::listaencuesta2();

        if (Auth::user()->idubigeodireccion) {
            $provinciasdireccion = Ubigeo::provincias(substr(Auth::user()->idubigeodireccion, 0, 2) . "0000");
            $distritosdireccion = Ubigeo::distritos(substr(Auth::user()->idubigeodireccion, 0, 4) . "00");
        }
        if (Auth::user()->idubigeonacimiento) {
            $provinciasnacimiento = Ubigeo::provincias(substr(Auth::user()->idubigeonacimiento, 0, 2) . "0000");
            $distritosnacimiento = Ubigeo::distritos(substr(Auth::user()->idubigeonacimiento, 0, 4) . "00");
        }

        if (Auth::user()->idubigeocolegio != null) {
            $provinciascolegio = Ubigeo::provincias(substr(Auth::user()->idubigeocolegio, 0, 2) . "0000");
            $distritoscolegio = Ubigeo::distritos(substr(Auth::user()->idubigeocolegio, 0, 4) . "00");
            $colegios = InstitucionEducativa::colegiosUbigeo(Auth::user()->idubigeocolegio);
        }

        return view('postulacion')->with('departamentos', $departamentos)
            ->with('provinciasdireccion', $provinciasdireccion)
            ->with('distritosdireccion', $distritosdireccion)
            ->with('provinciasnacimiento', $provinciasnacimiento)
            ->with('distritosnacimiento', $distritosnacimiento)
            ->with('provinciascolegio', $provinciascolegio)
            ->with('distritoscolegio', $distritoscolegio)
            ->with('colegios', $colegios)
            ->with('tarifas', $tarifas)
            ->with('escuelas', $escuelas)
            ->with('postulacion', $postulacion)
            ->with('encuesta1', $encuesta1)
            ->with('encuesta2', $encuesta2);
    }
    public function indexVerificado()
    {
        $postulacion = Postulacion::xPostulanteActual(Auth::id());
        $proceso = Proceso::find($postulacion->idproceso);
        $postulante = Auth::user();
        $postulante->edad = User::getEdad($postulante->fechanacimiento);
        //AGREGADO 17/09/2018 ->with('tarifa', $postulacion->idtarifa)
        return view('postulacionverificada')->with('postulacion', $postulacion)
            ->with('proceso', $proceso)
            ->with('tarifa', $postulacion->idtarifa)
            ->with('postulante', $postulante);
    }
    public function saveStep(Request $request)
    {
        if (!Proceso::abierto())
            return "Acceso Denegado";
        $step = $request->input('step_number');
        switch ($step) {
            case 1:
                return PostulacionController::step1($request);
                break;
            case 2:
                return PostulacionController::step2($request);
                break;
            case 3:
                return PostulacionController::step3($request);
                break;
            case 4:
                return PostulacionController::step4($request);
                break;
            default:
                return "false";
                break;
        }
    }
    public function step1(Request $request)
    {
        $messages = [
            'apepaterno.required' => 'El apellidos paterno es obligatorio.',
            'apematerno.required' => 'El apellido materno es obligatorio',
            'nombre.required' => 'El nombre es obligatorio.',
            'sexo.required' => 'Seleccione el sexo.',
            'tipodocumento.required' => 'Seleccione el tipo de documento.',
            'tipodocumento.between' => 'Selecciones un tipo de documento válido.',
            'dni.required' => 'El número de documento es obligatorio.',
            'dni.integer' => 'El número de documento debe contener sólo números.',
            'estadocivil.between' => 'Seleccione un estado civil válido.',
            'fechanacimiento.required' => 'La fecha de nacimiento es obligatoria.',
            'fechanacimiento.date' => 'Ingrese correctamente la fecha.',
            'fechanacimiento.before' => 'Ingrese una fecha de nacimiento válida.',
            'fechanacimiento.after' => 'Ingrese una fecha de nacimiento válida.',
            'extranjero.in' => 'Seleccion de nació en el extranjero es inválida.',
            'ubigeoextrangeropais.required_if' => 'El nombre del país de nacimiento es obligatorio.',
            'ubigeoextrangerodepartamento.required_if' => 'El nombre del departamento de nacimiento es obligatorio.',
            'ubigeoextrangeroprovincia.required_if' => 'El nombre de provincia de nacimiento es obligatorio.',
            'ubigeoextrangerodistrito.required_if' => 'El nombre de distrito de nacimiento es obligatorio.',
            'iddepartamentonacimiento.required_if' => 'Seleccione correctamente el lugar de nacimiento.',
            'iddepartamentonacimiento.exists' => 'Seleccione un departamento de nacimiento correcto.',
            'idprovincianacimiento.required_if' => 'Seleccione correctamente el lugar de nacimiento.',
            'idprovincianacimiento.exists' => 'Seleccione una provincia de nacimiento correcta.',
            'iddistritonacimiento.required_if' => 'Seleccione correctamente el lugar de nacimiento.',
            'iddistritonacimiento.exists' => 'Seleccione un distrito de nacimiento correcto.',
            'via.required' => 'Seleccione una via.',
            'via.between' => 'Seleccione una via correcta.',
            'direccion.required' => 'La dirección es obligatoria.',
            'telefono.max' => 'El teléfono puede ser hasta 50 caracteres.',
            'iddepartamentodirecion.required' => 'Seleccione correctamente su dirección.',
            'iddepartamentodirecion.exists' => 'Seleccione el departamento en el que vive.',
            'idprovinciadireccion.required' => 'Seleccione correctamente su dirección.',
            'idprovinciadireccion.exists' => 'Seleccione la provincia en la que vive.',
            'iddistritodireccion.required' => 'Seleccione correctamente su dirección.',
            'iddistritodireccion.exists' => 'Seleccione el distrito en el que vive.',
            'email.email' => 'Ingrese un email válido.=email',
            'celular.max' => 'El celular puede ser hasta 50 caracteres.',
            'duenocelular.required' => 'Seleccione el dueño del celular.',
            'duenocelular.between' => 'Seleccione el dueño del celular.',
            'padre.required' => 'Ingrese el nombre completo del padre.',
            'padre.min' => 'Ingrese el nombre completo del padre..',
            'madre.required' => 'Ingrese el nombre completo de la madre.',
            'madre.min' => 'Ingrese el nombre completo de la madre.',
            'iddepartamentocolegio.required_if' => 'Seleccione correctamente la dirección de su colegio.',
            'iddepartamentocolegio.exists' => 'Seleccione el departamento en donde se ubica su colegio.',
            'idprovinciacolegio.required_if' => 'Seleccione correctamente su dirección de su colegio.',
            'idprovinciacolegio.exists' => 'Seleccione la provincia en donde se ubica su colegio.',
            'iddistritocolegio.required_if' => 'Seleccione correctamente su dirección de su colegio.',
            'iddistritocolegio.exists' => 'Seleccione el distrito en donde se ubica su colegio.',
            'idinstitucioneducativa.required_if' => 'Seleccione una institución educativa de procedencia.',
            'idinstitucioneducativa.exists' => 'Seleccione una institución educativa de procedencia.',
            'nombreie.required_if' => 'Ingrese el nombre de la institución educativa de procedencia.',
            'otrainstitucion.required_if' => 'Ingrese el nombre de la institución educativa de procedencia.',
            'estatal.required_if' => 'Seleccione el tipo de institución.',
            'estatal.between' => 'Seleccione el tipo de institución.',
            'anotermino.required_if' => 'Ingrese el año en que concluyo la educación básica.',
            'anotermino.max' => 'Ingrese correctamente el año en que concluyo con la educación básica.',
            'anotermino.min' => 'Ingrese correctamente el año en que concluyo con la educación básica.',
            'estatal.required_if' => 'Seleccione el tipo de institución.'
        ];
        $validator = Validator::make($request->all(), [
            'apepaterno' => 'required|max:100|min:2',
            'apematerno' => 'required|max:100|min:2',
            'nombre' => 'required|max:100|min:2',
            'sexo' => 'required|in:M,F',
            'tipodocumento' => 'required|integer|between:1,5',
            'dni' => 'required|min:6|max:10',
            'dni' => 'integer',
            'estadocivil' => 'required|numeric|between:1,4',
            'fechanacimiento' => 'required|date|before:' . date('Y-m-d', strtotime('-15 year')) . '|after:' . date('Y-m-d', strtotime('-70 year')),
            'extranjero' => 'required|in:1,0',
            'ubigeoextrangeropais' => 'required_if:extranjero,1|max:100|min:2',
            'ubigeoextrangeroprovincia' => 'required_if:extranjero,1|max:100|min:2',
            'ubigeoextrangerodistrito' => 'required_if:extranjero,1|max:100|min:2',
            'idprovincianacimiento' => 'required_if:extranjero,0|exists:ubigeo,id',
            'iddistritonacimiento' => 'required_if:extranjero,0|exists:ubigeo,id',
            'via' => 'required|numeric|between:1,5',
            'direccion' => 'required|max:200|min:2',
            'numero' => 'nullable|max:10',
            'telefono' => 'max:50',
            'iddepartamentodirecion' => 'required|exists:ubigeo,id',
            'idprovinciadireccion' => 'required|exists:ubigeo,id',
            'iddistritodireccion' => 'required|exists:ubigeo,id',
            'email' => 'email',
            'celular' => 'nullable|max:50',
            'duenocelular' => 'required_if:celular,|numeric|in:0,1,2,3,4',
            'padre' => 'required|max:200|min:5',
            'madre' => 'required|max:200|min:5',

            'colegioextranjero' => 'nullable|in:1',
            'iddistritocolegio' => 'required_if:colegioextranjero,',
            'isotrainstitucion' => 'nullable|in:1,0',
            'isidinstitucioneducativa' => 'nullable|in:1,0',

            'nombreie' => 'required_if:colegioextranjero,1|min:1|max:200',
            'otrainstitucion' => 'required_if:isotrainstitucion,1|min:1|max:200',

            'estatal' => 'required_if:isidinstitucioneducativa,|in:1,0',
            'anotermino' => 'required|numeric|min:' . (date('Y') - 70) . '|max:' . (date('Y')),
        ], $messages)->validate();

        $user = Auth::user();
        $user->isotrainstitucion = $request->isotrainstitucion;
        $user->colegioextranjero = $request->colegioextranjero;
        if ($request->isidinstitucioneducativa == 1) {
            $validator = Validator::make(array('idinstitucioneducativa' => $request->idinstitucioneducativa), [
                'idinstitucioneducativa' => 'exists:institucion_educativa,id',
            ], $messages)->validate();

            $user->idinstitucioneducativa = $request->idinstitucioneducativa;
            $user->idubigeocolegio = $request->iddistritocolegio;
            $user->estatal = null;
            $user->nombreie = null;
        } else {
            $user->idubigeocolegio = null;
            $user->idinstitucioneducativa = null;
            $user->estatal = $request->estatal;
            if ($user->colegioextranjero == 1) {
                $user->nombreie = $request->nombreie;
            } elseif ($user->isotrainstitucion == 1) {
                $user->nombreie = $request->otrainstitucion;
                $user->idubigeocolegio = $request->iddistritocolegio;
                $user->estatal = $request->estatal;
            }
        }


        if (!$user->foto)
            return response()->json(['foto' => 'Necesita adjuntar una fotografía.'], 422);

        $user->apepaterno = $request->apepaterno;
        $user->apematerno = $request->apematerno;
        $user->nombre = $request->nombre;
        $user->sexo = $request->sexo;
        $user->tipodocumento = $request->tipodocumento;
        $user->dni = $request->dni;
        $user->estadocivil = $request->estadocivil;
        $user->fechanacimiento = $request->fechanacimiento;
        $user->extranjero = $request->extranjero;
        $user->ubigeoextrangeropais = $request->ubigeoextrangeropais;
        $user->ubigeoextrangerodepartamento = $request->ubigeoextrangerodepartamento;
        $user->ubigeoextrangeroprovincia = $request->ubigeoextrangeroprovincia;
        $user->ubigeoextrangerodistrito = $request->ubigeoextrangerodistrito;
        $user->idubigeonacimiento = $request->iddistritonacimiento;
        $user->via = $request->via;
        $user->direccion = $request->direccion;
        $user->numero = $request->numero;
        $user->telefono = $request->telefono;
        $user->idubigeodireccion = $request->iddistritodireccion;
        $user->email = $request->email;
        $user->celular = $request->celular;
        $user->duenocelular = $request->duenocelular;
        $user->padre = $request->padre;
        $user->madre = $request->madre;
        $user->estatal = $request->estatal;
        $user->anotermino = $request->anotermino;

        $msg = "";
        //return response()->json($this->cargarInformantePoblacion($ficha->id));
        if ($user->save()) {
            $msg = "Datos guardados correctamente.";
            return response()->json([
                'success' => true,
                'message' => $msg
            ]);
        }
    }
    public function step2(Request $request)
    {

        $messages = [
            'idtarifa.required' => 'Seleccione una modalidad de postulación.',
            'idtarifa.exists' => 'Seleccione una modalidad de postulación correcta.',
            'idescuela.required' => 'Seleccione la escuela a la que desea postular.',
            'idescuela.exists' => 'Seleccione la escuela a la que desea postular.',
            'medioseentero.required' => 'Seleccione el medio en dónde se enteró de la postuación.',
            'medioseentero.in' => 'Seleccione el medio por el cual se enteró de la postulación.',
            'dondesepreparo.required' => 'Seleccione el lugar en donde se preparó.',
            'dondesepreparo.in' => 'Seleccione el lugar en donde se preparó.',
        ];
        $validator = Validator::make($request->all(), [
            'idtarifa' => 'required|exists:tarifa,id',
            'idescuela' => 'required|exists:escuela,id',
            'medioseentero' => 'required|in:1,2,3,4,5,6,7,8',
            'dondesepreparo' => 'required|in:1,2,3,4,5'
        ], $messages)->validate();

        $postulacion = Postulacion::xPostulanteActual(Auth::id());
        $postulacion->idPostulante = Auth::id();
        $postulacion->estado = 1;
        $postulacion->idtarifa = $request->idtarifa;
        //$postulacion->costotarifa = Tarifa::find($postulacion->idtarifa)->costotarifa;
        //  MODIFICADO 11/09/2018 -- ->select('descripcion')
        $proceso = DB::table('proceso')
            ->select('descripcion', 'id')
            ->where('activo', '=', 1)
            ->get();

        $array = json_decode($proceso);
        $descripcion = "";
        //AGREGADO 06/09/2018 -- SUBIDO
        $idprocesoActual = "";

        foreach ($array as $obj) {
            $descripcion = $obj->descripcion;
            //AGREGADO 06/09/2018 -- SUBIDO
            $idprocesoActual = $obj->id;
        }

        $userr = DB::table('users')
            ->select('dni')
            ->where('id', Auth::id())
            ->get();
        $array1 = json_decode($userr);
        $dni = "";

        foreach ($array1 as $obj1) {
            $dni = $obj1->dni;
        }

        $pagos = DB::table('pagos')
            ->select('numerooperacion', 'importepagado')
            ->where('numerodocumento', $dni)
            ->where('estado', $descripcion)
            ->get();
        $array2 = json_decode($pagos);
        $operacionN = "";
        $SUMA = 0;
        foreach ($array2 as $obj) {
            $operacionN = $operacionN . $obj->numerooperacion . " - ";
            $SUMA += (float)$obj->importepagado;
        }

        $nuevonrooperacion = substr($operacionN, 0, -2);
        $postulacion->numerooperacion = $nuevonrooperacion;
        $postulacion->costotarifa = $SUMA;

        //AGREGADO 06/09/2018 -- SUBIDO
        $nroPostulacion = DB::table('postulacion')
            ->select(DB::raw('nroPostulante + 1  as nro,idproceso'))
            ->where('idproceso', '=', $idprocesoActual)
            ->orderBy('id', 'desc')
            ->limit(1)
            ->get();
        /*ANTERIOR CONTADOR DE POSTULANTE
        $nroPostulacion = DB::table('postulacion')
                    ->select(DB::raw('count(*)+1 as nro, idproceso'))
                     ->where('idproceso', '=', $idprocesoActual)
        //           ->where('idtarifa', '!=', '17')
                            ->groupBy('idproceso')
                            ->get();*/
                $arrayPostulacionNRO = json_decode($nroPostulacion);
                $nroPostulacionTOTAL = "";
                foreach ($arrayPostulacionNRO as $objnro) {
                    $nroPostulacionTOTAL = $objnro->nro;
                }
                if ($nroPostulacionTOTAL == "") {
                    $postulacion->nroPostulante = 1;
                } else {
                    $postulacion->nroPostulante = $nroPostulacionTOTAL;
                }

                $postulacion->idproceso = Proceso::abierto()->id;
                $postulacion->idescuela = $request->idescuela;
                $postulacion->medioseentero = $request->medioseentero;
                $postulacion->dondesepreparo = $request->dondesepreparo;
                $postulacion->created_at = new \DateTime();
                $tarifa = Tarifa::find($postulacion->idtarifa);
                if ($postulacion->save()) {

                    $proceso = Proceso::find($postulacion->idproceso);
                    $msg = "Datos guardados correctamente.";
                    return response()->json([
                        'success' => true,
                        'message' => $msg,
                        'costocarpeta' => $proceso->costocarpeta,
                        'costoprospecto' => $proceso->costoprospecto,
                        'costopostulacion' => $tarifa->costotarifa
                    ]);
                }
            }
            public function step3(Request $request)
            {
                $messages = [
                    'numerooperacion.required' => 'Ingrese el número de operación de su vaucher.',
                    'numerooperacion.numeric' => 'Ingrese un número de operación correcto.',
                    'numerooperacion.min' => 'Ingrese un número de operación correcto.',
                ];
                $validator = Validator::make($request->all(), [
                    'numerooperacion' => 'required|numeric|min:3'
                ], $messages)->validate();

                $postulacion = Postulacion::xPostulanteActual(Auth::id());
                $postulacion->numerooperacion = $request->numerooperacion;
                $postulacion->estado = 1;
                if ($postulacion->save()) {
                    $msg = "Datos guardados correctamente.";
                    return response()->json([
                        'success' => true,
                        'message' => $msg
                    ]);
                }
            }
            public function getPostulacion(Request $request)
            {
                //MODIFICADO 07/09/2018
                //$postulacion = Postulacion::where('id', $request->codigo)
                $postulacion = Postulacion::where('nroPostulante', $request->codigo)
                    ->where('estado', '<>', 0)
                    ->where('idproceso', '=', Proceso::abierto()->id)
                    ->first();
                if (!$postulacion)
                    return response()->json([
                        'success' => false,
                        'message' => "No se encontró ningún registro",
                    ]);

                $postulante = User::find($postulacion->idPostulante);
                $isCoordinador = Auth::user()->isCoordinador();

                return response()->json([
                    'success' => true,
                    'postulacion' => $postulacion,
                    'postulante' => $postulante,
                    'iscoordinador' => $isCoordinador
                ]);
            }
            public function verificar(Request $request)
            {
                if (!Proceso::abierto())
                    return "Acceso Denegado";
                $messages = [
                    'idPostulacion.required' => 'Se necesita el código de postulación',
                    'idPostulacion.exists' => 'Código de postulación no existe',
                    'apepaterno.required' => 'El apellidos paterno es obligatorio.',
                    'apematerno.required' => 'El apellido materno es obligatorio',
                    'nombre.required' => 'El nombre es obligatorio.',
                    'sexo.required' => 'Seleccione el sexo.',
                    'tipodocumento.required' => 'Seleccione el tipo de documento.',
                    'tipodocumento.between' => 'Selecciones un tipo de documento válido.',
                    'dni.required' => 'El número de documento es obligatorio.',
                    'dni.integer' => 'El número de documento debe contener sólo números.',
                    'estadocivil.between' => 'Seleccione un estado civil válido.',
                    'fechanacimiento.required' => 'La fecha de nacimiento es obligatoria.',
                    'fechanacimiento.date' => 'Ingrese correctamente la fecha.',
                    'fechanacimiento.before' => 'Ingrese una fecha de nacimiento válida.',
                    'fechanacimiento.after' => 'Ingrese una fecha de nacimiento válida.',
                    'extranjero.in' => 'Seleccion de nació en el extranjero es inválida.',
                    'ubigeoextrangeropais.required_if' => 'El nombre del país de nacimiento es obligatorio.',
                    'ubigeoextrangerodepartamento.required_if' => 'El nombre del departamento de nacimiento es obligatorio.',
                    'ubigeoextrangeroprovincia.required_if' => 'El nombre de provincia de nacimiento es obligatorio.',
                    'ubigeoextrangerodistrito.required_if' => 'El nombre de distrito de nacimiento es obligatorio.',
                    'iddepartamentonacimiento.required_if' => 'Seleccione correctamente el lugar de nacimiento.',
                    'iddepartamentonacimiento.exists' => 'Seleccione un departamento de nacimiento correcto.',
                    'idprovincianacimiento.required_if' => 'Seleccione correctamente el lugar de nacimiento.',
                    'idprovincianacimiento.exists' => 'Seleccione una provincia de nacimiento correcta.',
                    'iddistritonacimiento.required_if' => 'Seleccione correctamente el lugar de nacimiento.',
                    'iddistritonacimiento.exists' => 'Seleccione un distrito de nacimiento correcto.',
                    'via.required' => 'Seleccione una via.',
                    'via.between' => 'Seleccione una via correcta.',
                    'direccion.required' => 'La dirección es obligatoria.',
                    'telefono.max' => 'El teléfono puede ser hasta 50 caracteres.',
                    'iddepartamentodirecion.required' => 'Seleccione correctamente su dirección.',
                    'iddepartamentodirecion.exists' => 'Seleccione el departamento en el que vive.',
                    'idprovinciadireccion.required' => 'Seleccione correctamente su dirección.',
                    'idprovinciadireccion.exists' => 'Seleccione la provincia en la que vive.',
                    'iddistritodireccion.required' => 'Seleccione correctamente su dirección.',
                    'iddistritodireccion.exists' => 'Seleccione el distrito en el que vive.',
                    'email.email' => 'Ingrese un email válido.=email',
                    'celular.max' => 'El celular puede ser hasta 50 caracteres.',
                    'duenocelular.required' => 'Seleccione el dueño del celular.',
                    'duenocelular.between' => 'Seleccione el dueño del celular.',
                    'padre.required' => 'Ingrese el nombre completo del padre.',
                    'padre.min' => 'Ingrese el nombre completo del padre..',
                    'madre.required' => 'Ingrese el nombre completo de la madre.',
                    'madre.min' => 'Ingrese el nombre completo de la madre.',
                    'iddepartamentocolegio.required_if' => 'Seleccione correctamente la dirección de su colegio.',
                    'iddepartamentocolegio.exists' => 'Seleccione el departamento en donde se ubica su colegio.',
                    'idprovinciacolegio.required_if' => 'Seleccione correctamente su dirección de su colegio.',
                    'idprovinciacolegio.exists' => 'Seleccione la provincia en donde se ubica su colegio.',
                    'iddistritocolegio.required_if' => 'Seleccione correctamente su dirección de su colegio.',
                    'iddistritocolegio.exists' => 'Seleccione el distrito en donde se ubica su colegio.',
                    'idinstitucioneducativa.required_if' => 'Seleccione una institución educativa de procedencia.',
                    'idinstitucioneducativa.exists' => 'Seleccione una institución educativa de procedencia.',
                    'nombreie.required_if' => 'Ingrese el nombre de la institución educativa de procedencia.',
                    'otrainstitucion.required_if' => 'Ingrese el nombre de la institución educativa de procedencia.',
                    'estatal.required_if' => 'Seleccione el tipo de institución.',
                    'estatal.between' => 'Seleccione el tipo de institución.',
                    'anotermino.required_if' => 'Ingrese el año en que concluyo la educación básica.',
                    'anotermino.max' => 'Ingrese correctamente el año en que concluyo con la educación básica.',
                    'anotermino.min' => 'Ingrese correctamente el año en que concluyo con la educación básica.',
                    'estatal.required_if' => 'Seleccione el tipo de institución.',
                    'idtarifa.required' => 'Seleccione una modalidad de postulación.',
                    'idtarifa.exists' => 'Seleccione una modalidad de postulación correcta.',
                    'idescuela.required' => 'Seleccione la escuela a la que desea postular.',
                    'idescuela.exists' => 'Seleccione la escuela a la que desea postular.',
                    'numerooperacion.required' => 'Ingrese el Número de Operación del Baucher'
                ];
                $validator = Validator::make($request->all(), [
                    'idPostulacion' => 'required|exists:postulacion,id',
                    'apepaterno' => 'required|max:100|min:2',
                    'apematerno' => 'required|max:100|min:2',
                    'nombre' => 'required|max:100|min:2',
                    'sexo' => 'required|in:M,F',
                    'tipodocumento' => 'required|integer|between:1,5',
                    'dni' => 'required|min:6|max:10',
                    'dni' => 'integer',
                    'estadocivil' => 'required|numeric|between:1,4',
                    'fechanacimiento' => 'required|date|before:' . date('Y-m-d', strtotime('-15 year')) . '|after:' . date('Y-m-d', strtotime('-70 year')),
                    'extranjero' => 'required|in:1,0',
                    'ubigeoextrangeropais' => 'required_if:extranjero,1|max:100|min:2',
                    'ubigeoextrangeroprovincia' => 'required_if:extranjero,1|max:100|min:2',
                    'ubigeoextrangerodistrito' => 'required_if:extranjero,1|max:100|min:2',
                    'iddistritonacimiento' => 'required_if:extranjero,0',
                    'via' => 'required|numeric|between:1,5',
                    'direccion' => 'required|max:200|min:2',
                    'numero' => 'nullable|max:10',
                    'telefono' => 'max:50',
                    'iddepartamentodirecion' => 'required|exists:ubigeo,id',
                    'idprovinciadireccion' => 'required|exists:ubigeo,id',
                    'iddistritodireccion' => 'required|exists:ubigeo,id',
                    'email' => 'email',
                    'celular' => 'nullable|max:50',
                    'duenocelular' => 'required_if:celular,|numeric|in:0,1,2,3,4',
                    'padre' => 'required|max:200|min:5',
                    'madre' => 'required|max:200|min:5',

                    'colegioextranjero' => 'nullable|in:1',
                    'iddistritocolegio' => 'required_if:colegioextranjero,',
                    'isotrainstitucion' => 'nullable|in:1,0',
                    'isidinstitucioneducativa' => 'nullable|in:1,0',

                    'nombreie' => 'required_if:colegioextranjero,1|min:1|max:200',
                    'otrainstitucion' => 'required_if:isotrainstitucion,1|min:1|max:200',

                    'estatal' => 'required_if:isidinstitucioneducativa,|in:1,0',
                    'anotermino' => 'required|numeric|min:' . (date('Y') - 70) . '|max:' . (date('Y')),
                    'idtarifa' => 'required|exists:tarifa,id',
                    'idescuela' => 'required|exists:escuela,id',
                    'numerooperacion' => 'required',
                ], $messages)->validate();

                $postulacion = Postulacion::find($request->idPostulacion);
                $user = User::find($postulacion->idPostulante);
                $user->isotrainstitucion = $request->isotrainstitucion;
                $user->colegioextranjero = $request->colegioextranjero;
                if ($request->isidinstitucioneducativa == 1) {
                    $validator = Validator::make(array('idinstitucioneducativa' => $request->idinstitucioneducativa), [
                        'idinstitucioneducativa' => 'exists:institucion_educativa,id',
                    ], $messages)->validate();

                    $user->idinstitucioneducativa = $request->idinstitucioneducativa;
                    $user->idubigeocolegio = $request->iddistritocolegio;
                    $user->estatal = null;
                    $user->nombreie = null;
                } else {
                    $user->idubigeocolegio = null;
                    $user->idinstitucioneducativa = null;
                    $user->estatal = $request->estatal;
                    if ($user->colegioextranjero == 1) {
                        $user->nombreie = $request->nombreie;
                    } elseif ($user->isotrainstitucion == 1) {
                        $user->nombreie = $request->otrainstitucion;
                        $user->idubigeocolegio = $request->iddistritocolegio;
                        $user->estatal = $request->estatal;
                    }
                }


                if (!$user->foto)
                    return response()->json(['foto' => 'Necesita adjuntar una fotografía.'], 422);

                $user->apepaterno = $request->apepaterno;
                $user->apematerno = $request->apematerno;
                $user->nombre = $request->nombre;
                $user->sexo = $request->sexo;
                $user->tipodocumento = $request->tipodocumento;
                $user->dni = $request->dni;
                $user->estadocivil = $request->estadocivil;
                $user->fechanacimiento = $request->fechanacimiento;
                $user->extranjero = $request->extranjero;
                $user->ubigeoextrangeropais = $request->ubigeoextrangeropais;
                $user->ubigeoextrangerodepartamento = $request->ubigeoextrangerodepartamento;
                $user->ubigeoextrangeroprovincia = $request->ubigeoextrangeroprovincia;
                $user->ubigeoextrangerodistrito = $request->ubigeoextrangerodistrito;
                if (!$request->extranjero)
                    $user->idubigeonacimiento = $request->iddistritonacimiento;
                $user->via = $request->via;
                $user->direccion = $request->direccion;
                $user->numero = $request->numero;
                $user->telefono = $request->telefono;
                $user->idubigeodireccion = $request->iddistritodireccion;
                $user->email = $request->email;
                $user->celular = $request->celular;
                $user->duenocelular = $request->duenocelular;
                $user->padre = $request->padre;
                $user->madre = $request->madre;
                $user->estatal = $request->estatal;
                $user->anotermino = $request->anotermino;

                $postulacion->idVerificador = Auth::id();
                $postulacion->estado = 2;
                $postulacion->idtarifa = $request->idtarifa;
                //$postulacion->costotarifa = Tarifa::find($postulacion->idtarifa)->costotarifa;
                $proceso2 = DB::table('proceso')
                    ->select('descripcion')
                    ->where('activo', '=', 1)
                    ->get();

                $array = json_decode($proceso2);
                $descripcion2 = "";
                foreach ($array as $obj) {
                    $descripcion2 = $obj->descripcion;
                }



                $pagos2 = DB::table('pagos')
                    ->select('numerooperacion', 'importepagado')
                    ->where('numerodocumento', $request->dni)
                    ->where('estado', $descripcion2)
                    ->get();
                $array2 = json_decode($pagos2);
                $operacionN = "";
                $SUMA = 0;
                foreach ($array2 as $obj3) {

                    $SUMA += (float)$obj3->importepagado;
                }

                $postulacion->costotarifa = $SUMA;

                $postulacion->idescuela = $request->idescuela;
                $postulacion->numerooperacion = $request->numerooperacion;

                /*
                // Asignacion de ambiente para evaluacion sólo a examen general
                $tarifa = Tarifa::find($postulacion->idtarifa);
                if(Modalidad::find($tarifa->idmodalidad)->id == 1){
                    $escuela = Escuela::find($postulacion->idescuela);
                //  $am=Ambiente::getAmbienteOrdenado();
                    $ambientes = Ambiente::where('idarea', $escuela->idarea)
                            ->where('estado', '=', '1')
                            ->orderBy('proyector', 'asc')->get();

                foreach ($ambientes as $ambiente) {


        $cantidadOcupado =Postulacion::join('proceso as pr', 'postulacion.idProceso', '=', 'pr.id')        
                    ->select('p.id', 'p.idPostulante','p.idVerificador','p.idproceso',
        'p.idescuela','p.idtarifa','p.idambiente','p.estado','p.costotarifa',
        'p.medioseentero','p.dondesepreparo,p.numerooperacion','p.omg',
        'p.ome','p.puntaje','p.resultado','p.codalumno','p.created_at','p.updated_at','pr.descripcion','pr.activo')    
                    ->where('idambiente', $ambiente->id) 
                    ->where('activo','=',1)
                        ->count();
                        if($ambiente->capacidad > $cantidadOcupado){
                            $postulacion->idambiente = $ambiente->id;
                            break;
                        }
                    }
                }*/

        $postulacion->save();

        $msg = "";
        if ($user->save()) {
            $msg = "Datos guardados correctamente.";
            return response()->json([
                'success' => true,
                'message' => $msg
            ]);
        }
    }

    public function editar(Request $request)
    {
        //MODIFICADO 09/09/2018
        //$postulacion = Postulacion::find($request->idPostulacion);
        //AGREGAFO 09/09/2018
        $postulacion = Postulacion::where('nroPostulante', $request->idPostulacion)
            ->where('estado', '<>', 0)
            ->where('idproceso', '=', Proceso::abierto()->id)
            ->first();
        if (!$postulacion)
            return response()->json(['success' => false, 'message' => 'La postulacion no existe.']);

        $postulacion->estado = 1;
        if ($postulacion->save())
            return response()->json(['success' => true, 'message' => 'Modificado exitosamente.']);
    }

    public function cargarResultados()
    {
        if (!Proceso::abierto())
            return redirect("/");
        return view('cargarresultados');
    }

    public function cargarResultadosExcelPorTerminar(Request $request)
    {
        if (!Proceso::abierto())
            return "Acceso Denegado";
        $archivo =  Input::file('file');
        $nombreOriginal = $archivo->getClientOriginalName();
        $extension = $archivo->getClientOriginalExtension();
        $rl = \Storage::disk('archivos')->put($nombreOriginal, \File::get($archivo));
        $ruta = storage_path('archivos') . '/' . $nombreOriginal;
        $correcto = 0;
        $total = 0;
        Excel::selectSheetsByIndex(0)->load($ruta, function ($hoja) use (&$correcto, &$total) {
            $bien = 0;
            $datos = $hoja->get();
            foreach ($datos as $valor) {
                $postulacion = Postulacion::find($valor->codigopost);
                $arraypos = (DB::select("SELECT LPAD(POS.idescuela, 2, '0') as escuela,LPAD(MO.id, 2, '0') as modalidad,SUBSTRING(PRO.descripcion, 6, 5) as proceso,
			CASE 
			WHEN SUBSTRING(PRO.descripcion, 6, 5)='I' THEN CONCAT(SUBSTRING(PRO.descripcion, 3, 2),'2')
			WHEN SUBSTRING(PRO.descripcion, 6, 5)='II' THEN CONCAT(SUBSTRING(PRO.descripcion, 3, 2),'2') END as anioproceso 
			FROM postulacion POS
			INNER JOIN tarifa TA ON TA.id=POS.idtarifa
			INNER JOIN modalidad MO ON MO.id=TA.idmodalidad
			INNER JOIN proceso PRO ON PRO.id=POS.idproceso
			WHERE POS.id=$valor->codigopost"));

                $idescuela = '';
                $idmodalidad = '';
                $anioproceso = '';
                $codigoalumno = '';
                foreach ($arraypos as $obj) {
                    $idescuela = $obj->escuela;
                    $idmodalidad = $obj->modalidad;
                    $anioproceso = $obj->anioproceso;
                }
                $codigoalumno = $anioproceso . "." . $idescuela . $idmodalidad . "." . "001";

                if ($postulacion) {
                    $postulacion->omg = $valor->omg;
                    $postulacion->ome = $valor->ome;
                    $postulacion->puntaje = $valor->puntaje;
                    $postulacion->resultado = $valor->resultado;
                    $postulacion->codalumno = $codigoalumno;
                    if ($postulacion->save())
                        $bien++;
                }
            }
            $correcto = $bien;
            $total = count($datos);
        });
        return response()->json([
            'correcto' => $correcto,
            'total' => $total
        ]);
    }

    public function cargarResultadosExcel(Request $request)
    {
        if (!Proceso::abierto())
            return "Acceso Denegado";
        $archivo =  Input::file('file');
        $nombreOriginal = $archivo->getClientOriginalName();
        $extension = $archivo->getClientOriginalExtension();
        $rl = \Storage::disk('archivos')->put($nombreOriginal, \File::get($archivo));
        $ruta = storage_path('archivos') . '/' . $nombreOriginal;
        $correcto = 0;
        $total = 0;
        Excel::selectSheetsByIndex(0)->load($ruta, function ($hoja) use (&$correcto, &$total) {
            $bien = 0;
            $datos = $hoja->get();
            foreach ($datos as $valor) {
                $postulacion = Postulacion::find($valor->codigopost);
                if ($postulacion) {
                    $postulacion->omg = $valor->omg;
                    $postulacion->ome = $valor->ome;
                    $postulacion->puntaje = $valor->puntaje;
                    $postulacion->resultado = $valor->resultado;
                    $postulacion->codalumno = $valor->codigoalumno;
                    if ($postulacion->save())
                        $bien++;
                }
            }
            $correcto = $bien;
            $total = count($datos);
        });
        return response()->json([
            'correcto' => $correcto,
            'total' => $total
        ]);
    }

    public function finalizarPostulacion(Request $request)
    {

        if (!Proceso::abierto()) {
            return redirect("/");
        } else {

            $proceso = DB::table('proceso')
                ->select('descripcion')
                ->where('activo', '=', 1)
                ->get();

            $array = json_decode($proceso);
            $descripcion = "";
            foreach ($array as $obj) {
                $descripcion = $obj->descripcion;
            }

            $userr = DB::table('users')
                ->select('dni')
                ->where('id', Auth::id())
                ->get();
            $array1 = json_decode($userr);
            $dni = "";

            foreach ($array1 as $obj1) {
                $dni = $obj1->dni;
            }

            $pagos = DB::table('pagos')
                ->select('numerooperacion', 'importepagado')
                ->where('numerodocumento', $dni)
                ->where('estado', $descripcion)
                ->get();
            $array = json_decode($pagos);
            $operacionN = "";
            $SUMA = 0;
            foreach ($array as $obj) {
                $operacionN = $operacionN . $obj->numerooperacion . " - ";
                $SUMA += (float)$obj->importepagado;
            }

            if ($operacionN == null) {
                return redirect('/');
            } else {
                //return view('postulacionverificada');
                $postulacion = Postulacion::xPostulanteActual(Auth::id());



                /*
         $tarifa = Tarifa::find($postulacion->idtarifa);
        if(Modalidad::find($tarifa->idmodalidad)->id == 1){
            $escuela = Escuela::find($postulacion->idescuela);
         //  $am=Ambiente::getAmbienteOrdenado();
            $ambientes = Ambiente::where('idarea', $escuela->idarea)
                    ->where('estado', '=', '1')
                    ->orderBy('proyector', 'asc')->get();

           foreach ($ambientes as $ambiente) {


               $cantidadOcupado =Postulacion::join('proceso as pr', 'postulacion.idProceso', '=', 'pr.id')        
               ->select('p.id', 'p.idPostulante','p.idVerificador','p.idproceso',
               'p.idescuela','p.idtarifa','p.idambiente','p.estado','p.costotarifa',
               'p.medioseentero','p.dondesepreparo,p.numerooperacion','p.omg',
               'p.ome','p.puntaje','p.resultado','p.codalumno','p.created_at','p.updated_at','pr.descripcion','pr.activo')    
               ->where('idambiente', $ambiente->id) 
               ->where('activo','=',1)
                ->count();
                if($ambiente->capacidad > $cantidadOcupado){

                    $postulacion->idambiente = $ambiente->id;
                    
                    break;
                }
            }
        }
              */

                $tarifa = Tarifa::find($postulacion->idtarifa);
                //if(Modalidad::find($tarifa->idmodalidad)->id == 1){
                //MODIFICADO 06/09/2018
                //TIPO DE EXAMEN = 1 :::::: EXAMEN GENERAL
                if (Modalidad::find($tarifa->tipoexamen)->id == 1) {
                    $escuela = Escuela::find($postulacion->idescuela);
                    //  $am=Ambiente::getAmbienteOrdenado();
                    $ambientes = Ambiente::where('idarea', $escuela->idarea)
                        ->where('estado', '=', '1')
                        ->orderBy('proyector', 'asc')->get();

                    foreach ($ambientes as $ambiente) {


                        $cantidadOcupado = Postulacion::join('proceso as pr', 'postulacion.idProceso', '=', 'pr.id')
                            ->select(
                                'p.id',
                                'p.idPostulante',
                                'p.idVerificador',
                                'p.idproceso',
                                'p.idescuela',
                                'p.idtarifa',
                                'p.idambiente',
                                'p.estado',
                                'p.costotarifa',
                                'p.medioseentero',
                                'p.dondesepreparo,p.numerooperacion',
                                'p.omg',
                                'p.ome',
                                'p.puntaje',
                                'p.resultado',
                                'p.codalumno',
                                'p.created_at',
                                'p.updated_at',
                                'pr.descripcion',
                                'pr.activo'
                            )
                            ->where('idambiente', $ambiente->id)
                            ->where('activo', '=', 1)
                            ->count();
                        if ($ambiente->capacidad > $cantidadOcupado) {

                            $postulacion->idambiente = $ambiente->id;

                            break;
                        }
                    }
                    //AGREGADO 06/09/2018
                } else {
                    //TIPO DE EXAMEN = 2 :::::: EXAMEN ESPECIAL
                    if (Modalidad::find($tarifa->tipoexamen)->id == 2) {
                        //$ambientes = Ambiente::where('idarea', 4)
                        //SE MODIFICO 06/11/2019 HRODRIGUEZ
                        $ambientes = Ambiente::where('idarea', 5)
                            ->where('estado', '=', '1')
                            ->orderBy('proyector', 'asc')->get();

                        foreach ($ambientes as $ambiente) {


                            $cantidadOcupado = Postulacion::join('proceso as pr', 'postulacion.idProceso', '=', 'pr.id')
                                ->select(
                                    'p.id',
                                    'p.idPostulante',
                                    'p.idVerificador',
                                    'p.idproceso',
                                    'p.idescuela',
                                    'p.idtarifa',
                                    'p.idambiente',
                                    'p.estado',
                                    'p.costotarifa',
                                    'p.medioseentero',
                                    'p.dondesepreparo,p.numerooperacion',
                                    'p.omg',
                                    'p.ome',
                                    'p.puntaje',
                                    'p.resultado',
                                    'p.codalumno',
                                    'p.created_at',
                                    'p.updated_at',
                                    'pr.descripcion',
                                    'pr.activo'
                                )
                                ->where('idambiente', $ambiente->id)
                                ->where('activo', '=', 1)
                                ->count();
                            if ($ambiente->capacidad > $cantidadOcupado) {

                                $postulacion->idambiente = $ambiente->id;

                                break;
                            }
                        }
                    }
                    //TIPO DE EXAMEN = 3 o OTROS o NULL :::::: CPU NO GENERA AULAS
                }

                $nuevonrooperacion = substr($operacionN, 0, -2);
                $postulacion->numerooperacion = $nuevonrooperacion;
                $postulacion->costotarifa = $SUMA;
                $postulacion->estado = 2;
                $postulacion->idVerificador = 3;

                $msg = "";
                if ($postulacion->save()) {
                    //return redirect('/');
                    $postulante = Auth::user();
                    $postulante->edad = User::getEdad($postulante->fechanacimiento);
                    //MODIFICADO return view('postulacionverificada')->with('postulante', $postulante);
                    return view('postulacionverificada')->with('tarifa', $postulacion->tarifa)
                        ->with('postulante', $postulante);
                    //return redirect('/');
                }
            }
        }
    }

    public function SubirArchivo(Request $request)
    {
        $archivo = $request->file('archivo_oculto1');
        $nombreOriginal = $archivo->getClientOriginalName();
        $extension = $archivo->getClientOriginalExtension();
        $rl = \Storage::disk('documentos')->put($nombreOriginal, \File::get($archivo));
        $ruta = storage_path('documentos') . '/' . $nombreOriginal;
    }

    public function Enviar()
    {
        if (!Proceso::abierto())
            return redirect("/");
        return view("/postular");
    }

    public function EnviarCorreo(Request $request)
    {
        try {

            $userE = DB::table('users')
                ->select('dni')
                ->where('id', Auth::id())
                ->get();
            $array2 = json_decode($userE);
            $dniE = "";

            foreach ($array2 as $obj1) {
                $dniE = $obj1->dni;
            }

            $edad = $request->input('edad');;
            if ($edad >= "18") {

                $archivo = $request->file('archivo_oculto1');
                $nombreOriginal = $archivo->getClientOriginalName();
                $extension = $archivo->getClientOriginalExtension();

                if ($extension == "pdf") {
                    $r = \Storage::disk('documentos')->put("FI" . $dniE . "." . $extension, \File::get($archivo));
                }

                $archivo1 = $request->file('archivo_oculto2');
                $nombreOriginal1 = $archivo1->getClientOriginalName();
                $extension1 = $archivo1->getClientOriginalExtension();

                if ($extension1 == "pdf") {
                    $r1 = \Storage::disk('documentos')->put("AP" . $dniE . "." . $extension1, \File::get($archivo1));
                }

                $archivo2 = $request->file('archivo_oculto3');
                $nombreOriginal2 = $archivo2->getClientOriginalName();
                $extension2 = $archivo2->getClientOriginalExtension();

                if ($extension2 == "pdf") {
                    $r2 = \Storage::disk('documentos')->put("D" . $dniE . "." . $extension2, \File::get($archivo2));
                }

                $archivo3 = $request->file('archivo_oculto4');
                $nombreOriginal3 = $archivo3->getClientOriginalName();
                $extension3 = $archivo3->getClientOriginalExtension();

                if ($extension3 == "pdf") {
                    $r3 = \Storage::disk('documentos')->put("BP" . $dniE . "." . $extension3, \File::get($archivo3));
                }

                $nombreOriginalY = "FI" . $dniE . ".pdf";
                $ruta = storage_path('documentos') . '/' . $nombreOriginalY;

                $nombreOriginal1Y = "AP" . $dniE . ".pdf";
                $ruta2 = storage_path('documentos') . '/' . $nombreOriginal1Y;

                $nombreOriginal2Y = "D" . $dniE . ".pdf";
                $ruta3 = storage_path('documentos') . '/' . $nombreOriginal2Y;

                $nombreOriginal3Y = "BP" . $dniE . ".pdf";
                $ruta4 = storage_path('documentos') . '/' . $nombreOriginal3Y;

                $user = DB::table('users')
                    ->select('dni', 'nombre', 'apepaterno', 'apematerno', 'celular', 'email')
                    ->where('id', Auth::id())
                    ->get();
                $array1 = json_decode($user);

                $dniX = "";
                $nombre = "";
                $apellido_paterno = "";
                $apellido_materno = "";
                $celular = "";
                $email = "";

                foreach ($array1 as $obj1) {
                    $dniX = $obj1->dni;
                    $nombre = $obj1->nombre;
                    $apellido_paterno = $obj1->apepaterno;
                    $apellido_materno = $obj1->apematerno;
                    $celular = $obj1->celular;
                    $email = $obj1->email;
                }

                $dni = $dniX;
                $nombre = $nombre;
                $apellido_paterno = $apellido_paterno;
                $apellido_materno = $apellido_materno;
                $celular = $celular;
                $correo = $email;

                //echo"<script>alert('11  $nombreempresa'); </script>";

                $mail = new email;

                $mail->From = "$correo"; //EMISOR: ACA EL CORREO DEL POSTULANTE
                $mail->FromName = "$nombre $apellido_paterno $apellido_materno"; //NOMBRE DEL EMISOR: ACA EL NOMBRE DEL POSTULANTE
                $mail->Subject = "DOCUMENTOS ESCANEADOS";
                $mail->MsgHTML("<h1>NOMBRES Y APELLIDOS: $nombre $apellido_paterno $apellido_materno</h1><br><h1>CORREO: $correo</h1><br><h1>$celular</h1>"); //CUERPO DEL CORREO: ACA EL NOMBRE Y APELLIDOS DEL POSTULANTE, CON SU DNI, Y SU CELULAR

                $mail->AddAttachment($ruta); //ARCHIVO ADJUNTO: ACA SU CV FISICO CON SU NOMBRE DE ARCHIVO DE DNI(VALIDAR SI NO EXISTE QUE LE SALGA UN AVISO QUE DEBE DE SUBIR SU CV EN "MI CV")

                $mail->AddAttachment($ruta2); //ARCHIVO ADJUNTO: ACA SU CV FISICO CON SU NOMBRE DE ARCHIVO DE DNI(VALIDAR SI NO EXISTE QUE LE SALGA UN AVISO QUE DEBE DE SUBIR SU CV EN "MI CV")

                $mail->AddAttachment($ruta3); //ARCHIVO ADJUNTO: ACA SU CV FISICO CON SU NOMBRE DE ARCHIVO DE DNI(VALIDAR SI NO EXISTE QUE LE SALGA UN AVISO QUE DEBE DE SUBIR SU CV EN "MI CV")

                $mail->AddAttachment($ruta4); //ARCHIVO ADJUNTO: ACA SU CV FISICO CON SU NOMBRE DE ARCHIVO DE DNI(VALIDAR SI NO EXISTE QUE LE SALGA UN AVISO QUE DEBE DE SUBIR SU CV EN "MI CV")

                $mail->AddAddress("admision@unab.edu.pe", "ADMISION UNAB"); //DESTINATARIO: ACA CORREO DE LA EMPRESA

                //$mail->AddCC("ing.ray.yanac@gmail.com","Ray Yanac"); //DESTINATARIO COPIA
                $mail->AddBCC("jrodriguez@unab.edu.pe", "ADMISION UNAB"); //DESTINATARIO COPIA OCULTA: ACA EL CORREO DE LA UNIVERSIDAD PARA QUE VERIFIQUEN QUE SE 

                $mail->IsHTML(true);
                $mail->Send();

                return response()->json(['edad' => $edad, 'mensaje' => "Se envio su documentos correctamente. Dar click en finalizar postulacion"]);
            } else {

                $archivo = $request->file('archivo_oculto1');
                $nombreOriginal = $archivo->getClientOriginalName();
                $extension = $archivo->getClientOriginalExtension();

                if ($extension == "pdf") {
                    $r = \Storage::disk('documentos')->put("FI" . $dniE . "." . $extension, \File::get($archivo));
                }

                $archivo2 = $request->file('archivo_oculto3');
                $nombreOriginal2 = $archivo2->getClientOriginalName();
                $extension2 = $archivo2->getClientOriginalExtension();

                if ($extension2 == "pdf") {
                    $r2 = \Storage::disk('documentos')->put("D" . $dniE . "." . $extension2, \File::get($archivo2));
                }

                $archivo3 = $request->file('archivo_oculto4');
                $nombreOriginal3 = $archivo3->getClientOriginalName();
                $extension3 = $archivo3->getClientOriginalExtension();

                if ($extension3 == "pdf") {
                    $r3 = \Storage::disk('documentos')->put("BP" . $dniE . "." . $extension3, \File::get($archivo3));
                }


                $nombreOriginalX = "FI" . $dniE . ".pdf";
                $ruta = storage_path('documentos') . '/' . $nombreOriginalX;

                $nombreOriginal1X = "D" . $dniE . ".pdf";
                $ruta2 = storage_path('documentos') . '/' . $nombreOriginal1X;

                $nombreOriginal2X = "BP" . $dniE . ".pdf";
                $ruta3 = storage_path('documentos') . '/' . $nombreOriginal2X;


                $user = DB::table('users')
                    ->select('dni', 'nombre', 'apepaterno', 'apematerno', 'celular', 'email')
                    ->where('id', Auth::id())
                    ->get();
                $array1 = json_decode($user);

                $dniX = "";
                $nombre = "";
                $apellido_paterno = "";
                $apellido_materno = "";
                $celular = "";
                $email = "";

                foreach ($array1 as $obj1) {
                    $dniX = $obj1->dni;
                    $nombre = $obj1->nombre;
                    $apellido_paterno = $obj1->apepaterno;
                    $apellido_materno = $obj1->apematerno;
                    $celular = $obj1->celular;
                    $email = $obj1->email;
                }

                $dni = $dniX;
                $nombre = $nombre;
                $apellido_paterno = $apellido_paterno;
                $apellido_materno = $apellido_materno = "";
                $celular = $celular = "";
                $correo = $email;

                //echo"<script>alert('11  $nombreempresa'); </script>";

                $mail = new email;

                $mail->From = "$correo"; //EMISOR: ACA EL CORREO DEL POSTULANTE
                $mail->FromName = "$nombre $apellido_paterno $apellido_materno"; //NOMBRE DEL EMISOR: ACA EL NOMBRE DEL POSTULANTE
                $mail->Subject = "DOCUMENTOS ESCANEADOS";
                $mail->MsgHTML("<h1>NOMBRES Y APELLIDOS: $nombre $apellido_paterno $apellido_materno</h1><br><h1>CORREO: $correo</h1><br><h1>$celular</h1>"); //CUERPO DEL CORREO: ACA EL NOMBRE Y APELLIDOS DEL POSTULANTE, CON SU DNI, Y SU CELULAR

                $mail->AddAttachment($ruta); //ARCHIVO ADJUNTO: ACA SU CV FISICO CON SU NOMBRE DE ARCHIVO DE DNI(VALIDAR SI NO EXISTE QUE LE SALGA UN AVISO QUE DEBE DE SUBIR SU CV EN "MI CV")

                $mail->AddAttachment($ruta2); //ARCHIVO ADJUNTO: ACA SU CV FISICO CON SU NOMBRE DE ARCHIVO DE DNI(VALIDAR SI NO EXISTE QUE LE SALGA UN AVISO QUE DEBE DE SUBIR SU CV EN "MI CV")

                $mail->AddAttachment($ruta3); //ARCHIVO ADJUNTO: ACA SU CV FISICO CON SU NOMBRE DE ARCHIVO DE DNI(VALIDAR SI NO EXISTE QUE LE SALGA UN AVISO QUE DEBE DE SUBIR SU CV EN "MI CV")

                $mail->AddAddress("admision@unab.edu.pe", "assddsjdfs"); //DESTINATARIO: ACA CORREO DE LA EMPRESA

                //$mail->AddCC("ing.ray.yanac@gmail.com","Ray Yanac"); //DESTINATARIO COPIA
                $mail->AddBCC("jrodriguez@unab.edu.pe", "UNAB-BOLSA de TRABAJO"); //DESTINATARIO COPIA OCULTA: ACA EL CORREO DE LA UNIVERSIDAD PARA QUE VERIFIQUEN QUE SE 

                $mail->IsHTML(true);
                $mail->Send();

                return response()->json(['edad' =>  $edad, 'mensaje' => "Se envio su documentos correctamente. Dar click en finalizar postulacion"]);
            }
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}
