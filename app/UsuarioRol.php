<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsuarioRol extends Model
{
    protected $table = 'usuario_rol';

    protected $fillable = [
        'idrol', 'iduser',
    ];
}
