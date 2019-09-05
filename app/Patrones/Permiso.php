<?php

namespace App\Patrones;
use Auth;

use Illuminate\Http\Request;
use Jenssegers\Date\Date;
use App\Patrones\Rol;

class Permiso
{
    public static function esAdministrador(){
        return Auth::user()->rol === \App\Patrones\Rol::Administrador;
    }

    public static function esVendedor(){
        return Auth::user()->rol === \App\Patrones\Rol::Vendedor;
    }
}
