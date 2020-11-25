<?php

namespace App;
use App\Rol;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre', 'apepaterno', 'apematerno', 'tipodocumento', 'dni', 'email', 'password',
    ];
    
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles()
    {
        return Rol::join('usuario_rol', 'rol.id', '=', 'usuario_rol.idrol')
                    ->select('rol.id', 'rol.nombre', 'rol.descripcion')
                    ->where('iduser', $this->id)->get();
    }

    public function departamentoNacimiento()
    {
        return Ubigeo::getDepartamento(Auth::user()->idubigeonacimiento);
    }
    public function provinciaNacimiento()
    {
        return Ubigeo::getProvincia(Auth::user()->idubigeonacimiento);
    }
    public function distritoNacimiento()
    {
        return Ubigeo::getDistrito(Auth::user()->idubigeonacimiento);
    }

    public static function getEdad($fechanacimiento)
    {
        list($Y,$m,$d) = explode("-",$fechanacimiento);
        return( date("md") < $m.$d ? date("Y")-$Y-1 : date("Y")-$Y );
    }

    private function isRol($idrol)
    {
        $rol = Rol::join('usuario_rol', 'rol.id', '=', 'usuario_rol.idrol')
                    ->select('rol.id', 'rol.nombre', 'rol.descripcion')
                    ->where('iduser', $this->id)
                    ->where('idrol', $idrol)->first();
        if($rol)
            return 1;
        else 
            return 0;
    }

    public function isAdmin()
    {
        return $this->isRol(1);     
    }
    public function isCoordinador()
    {
        return $this->isRol(2);
    }
    public function isAsistente()
    {
        return $this->isRol(3);
    }
    public function isDocente()
    {
        return $this->isRol(4);
    }
    public function isAlumno()
    {
        return $this->isRol(5);
    }
    public function isPostulante()
    {
        return $this->isRol(6);
    }
}
