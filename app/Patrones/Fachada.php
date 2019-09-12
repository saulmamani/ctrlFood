<?php

namespace App\Patrones;

use Auth;

use Illuminate\Http\Request;
use Jenssegers\Date\Date;
use App\User;
use App\Patrones\Rol;

class Fachada
{
    public static function datosEmpresa()
    {
        return [
            'nombre' => 'SALI Restaurant',
            'nit' => '3095304010',
            'direccion' => 'Plan 500 Av. Heroes del Chaco #232',
            'telefono' => '76137269',
        ];
    }

    public static function roles()
    {
        return array(
            Rol::Vendedor => Rol::Vendedor . ' - Ejecutivo de ventas',
            Rol::Administrador => Rol::Administrador . ' - Tiene acceso completo al sistema',
        );
    }

    public static function categoriasProducto()
    {
        return [
            null => 'Selecciones tipo',
            'Comida' => 'Comida',
            'Bebida' => 'Bebida',
        ];
    }

    public static function formarFechaHora($soloFecha)
    {
        $hora = date('H:i:s');
        $fecha = $soloFecha . ' ' . $hora;
        return \DateTime::createFromFormat('d/m/Y H:i:s', $fecha);
    }

    public static function fechaHoraControlador()
    {
        $soloFecha = date('d/m/Y');
        $hora = date('H:i:s');
        $fecha = $soloFecha . ' ' . $hora;
        return \DateTime::createFromFormat('d/m/Y H:i:s', $fecha);
    }

    public static function fechaHora()
    {
        return date('d/m/Y H:i:s');
    }

    public static function fechaLiteral($fecha)
    {
        Date::setLocale('es');
        $fecha = \DateTime::createFromFormat('m/d/Y', $fecha);
        $date = new Date($fecha);
        return $date->format('j \d\e F \d\e Y');
    }

    public static function estadoVenta()
    {
        return [
            '1' => 'Activos',
            '0' => 'Anulados',
        ];
    }
}
