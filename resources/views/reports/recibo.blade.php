<!DOCTYPE html>
<html lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">

    <title>Recibo</title>
    <style>
        @page {
            size: 108mm 297mm;
            margin: 5mm;
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

        .mytable, .mytable td, .mytable th {
            border: 1px solid black;
            border-collapse: collapse;
            border-color: #ddd;
        }

        table {
            width: 100%;
        }

        button {
            padding: 5px;
        }

        .anulado {
            width: 100%;
            font-size: 45px;
            position: absolute;
            text-align: center;
            color: red;
            opacity: .7;
        }
    </style>

    <style media="print">
        .noprint {
            display: none;
        }
    </style>
</head>
<body>

<p class="noprint right" style="border-bottom: 1px solid #D0D0D0; padding-bottom: 10px">
    <button onclick="window.print()">= Imprimir</button>
</p>

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

<table>
    <tr>
        <td colspan="2">
            <h3 class="center"><u>R E C I B O</u></h3>
            @if(!$sale->estado )
                <h1 class="anulado">A N U L A D O</h1>
            @endif
        </td>
    </tr>
    <tr>
        <td>
            <strong>Nro. Recibo: {{ $sale->numero }}</strong>
        </td>
        <td class="right">
            <strong>Fecha: </strong>{!! date('d/m/Y', strtotime($sale->fecha)) !!}
        </td>
    </tr>
</table>

<table>
    <tr>
        <td>
            <strong>Nit / Ci: </strong> {{ $sale->nit}} <br>
            <strong>Razón Social: </strong> {{ $sale->razon_social }} <br>
            <strong>Concepto: </strong> {{ $sale->concepto }} <br>
        </td>
    </tr>
</table>

<div style="height: 750px;">
    <table class="mytable">
        <tr class="center">
            <th>CANT.</th>
            <th>DESCRIPCION</th>
            <th>PRECIO</th>
            <th>IMPORTE</th>
        </tr>
        @foreach ($details as $row)
            <tr>
                <td class="center">{{ $row->cantidad }}</td>
                <td>{{ $row->products->nombre}}</td>
                <td class="right">{{ $row->precio }} </td>
                <td class="right">{{ $row->cantidad * $row->precio }} </td>
            </tr>
        @endforeach
        <tr>
            <td class="right" colspan="3"><strong>Total [Bs] </strong></td>
            <td class="right"><strong>{{ $sale->total }}</strong></td>
        </tr>
    </table>

    <table>
        <tr>
            <td>
                <i>Son: {{ \NumerosEnLetras::convertir($sale->total,'Bolivianos',false) }}</i>
            </td>
            <td class="right">
                @php
                    $info_qr = $sale->numero;
                    $info_qr .= '|' . $sale->nit;
                    $info_qr .= '|' . $sale->razon_social;
                    $info_qr .= '|' . $sale->total;
                @endphp
                {!! \QrCode::size(150)->generate($info_qr); !!}
            </td>
        </tr>
    </table>
</div>

<div style="border-top: 2px dotted #1b1e21; padding: 2px">
    <h4>
        Número de ticket: {{ $sale->numero_ticket }} <br>
        Fecha y hora: {!! date('d/m/Y H:i', strtotime($sale->fecha)) !!}
    </h4>
</div>


</body>

</html>
