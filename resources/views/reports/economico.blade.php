<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte economico</title>
    <style>
        @page {
            margin-top: 5mm;
        }

        body {
            margin: 0;
            padding: 0;
            font-size: 10pt;
        }

        .center {
            text-align: center;
        }

        .right {
            text-align: right
        }

        .mytable {
            width: 100%;
        }

        .mytable, .mytable td, .mytable th {
            border: 1px solid black;
            border-collapse: collapse;
            border-color: #ddd;
        }

        table {
            width: 100%;
        }
    </style>
</head>
<body>

<table>
    <tr>
        <td class="center">
            <h3> {!! \App\Patrones\Fachada::datosEmpresa()['nombre'] !!} </h3>
            {!! \App\Patrones\Fachada::datosEmpresa()['direccion'] !!} <br>
            <strong>NIT: </strong> {!! \App\Patrones\Fachada::datosEmpresa()['nit'] !!}<br>
            <strong>TEL/CEL: </strong> {!! \App\Patrones\Fachada::datosEmpresa()['telefono'] !!}<br>
        </td>
    </tr>
</table>

<h2 CLASS="center"><u>REPORTE ECONÓMICO</u></h2>
<p>
    Desde: {{ $_GET['txtDesde'] }} -
    Hasta: {{ $_GET['txtHasta'] }}
    <br>
    Estado:
    @if( $_GET['txtEstado'] )
        <span>Activo</span>
    @else
        <span>Anulado</span>
    @endif
    -
    Filtrado por: {{ $_GET['txtBuscar'] }}
</p>

@include("reports.table")

</body>
</html>
