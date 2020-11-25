<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Usuarios;
use App\Rol;
use App\User;
use App\UsuarioRol;
use App\Ubigeo;
use App\Tarifa;
use App\Escuela;
use DB;

class UsuariosController extends Controller
{
  



public function __construct()
    {
        $this->middleware('auth');
    }

  public function index()
    {
    	      
        $departamentos = Ubigeo::departamentos();
        $tarifas = Tarifa::allactivo();
        $escuelas = Escuela::allactivo();
        $roles=Rol::allactivo();
        return view('mantenimiento.usuarios')->with('departamentos', $departamentos)
                                            ->with('tarifas', $tarifas)
                                            ->with('escuelas', $escuelas)
                                            ->with('roles', $roles);



    }


 
   public function listausuariosPorRol()
    { 
    	
        $usuarios =Usuarios::join('usuario_rol', 'users.id', '=', 'usuario_rol.iduser')  
            ->join('rol', 'rol.id', '=', 'usuario_rol.idrol')        
            ->select('users.id as idUsuario','users.dni', 'users.email','rol.nombre as nombrerol',DB::raw('CONCAT(users.apepaterno, " ", users.apematerno) as apellidos'))
             ->get();

       return response()->json(['usuarios' => $usuarios]);

    }


    public function editar(Request $request)
    {
        $usuarios = Usuarios::find($request->id);
        if(!$usuarios)
            return response()->json(['success' => false, 'message' => 'La postulacion no existe.']);

        $usuarios->estado =1;
        if($usuarios->save())
            return response()->json(['success' => true, 'message' => 'Modificado exitosamente.']);            
    }



public function listarusuario(Request $request)
{

    $usoarioslistado=Usuarios::where('id','=',$request->idUsuarios)->first();
    $rol=UsuarioRol::where('idUser','=',$usoarioslistado->id)->first();
       if(!$usoarioslistado)
            return response()->json(['error' => false,
                                    'message' => "No se encontró ningún registro",
                                    ]);

          return response()->json(['success' => true,                                  
                                    'usuario' => $usoarioslistado,
                                    'rol' => $rol
                                     ]);

}






 public function usuarios(Request $request)
    {
      
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
            'fechanacimiento' => 'required|date|before:'.date('Y-m-d', strtotime('-15 year')).'|after:'.date('Y-m-d', strtotime('-70 year')),
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

        ], $messages)->validate();

        
}

}