@php
    $desde = isset($_GET['txtDesde']) ?  $_GET['txtDesde'] : date("d/m/Y");
    $hasta = isset($_GET['txtHasta']) ?  $_GET['txtHasta'] : date("d/m/Y");
    $buscar = isset($_GET['txtBuscar']) ?  $_GET['txtBuscar'] : null;
    $estado = isset($_GET['txtEstado']) ?  $_GET['txtEstado'] : 1;
@endphp

<div class="row">
    <form action="{{ url('sales') }}">

        <div class="form-group col-sm-3">
            {!! Form::label('txtBuscar', 'Buscar por:') !!}
            {!! Form::text('txtBuscar', $buscar, ['class' => 'form-control', 'placeholder'=>'Nit, Cliente, Numero']) !!}
        </div>

        <div class="form-group col-sm-2">
            {!! Form::label('txtEstado', 'Estado:') !!}
            {!! Form::select('txtEstado', \App\Patrones\Fachada::estadoVenta() ,$estado, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group col-sm-2">
            {!! Form::label('txtDesde', 'Desde:') !!}
            {!! Form::text('txtDesde',$desde, ['class' => 'form-control datepicker', 'autocomplete' => 'off']) !!}
        </div>

        <div class="form-group col-sm-2">
            {!! Form::label('txtHasta', 'Hasta:') !!}
            {!! Form::text('txtHasta',$hasta, ['class' => 'form-control datepicker', 'autocomplete' => 'off']) !!}
        </div>

        <div class="form-group col-sm-3" style="margin-top: 25px">
            <button type="submit" class="btn btn-success"><i class="glyphicon glyphicon-search"></i> Buscar</button>
            <a href="#" class="btn btn-default"><i class="glyphicon glyphicon-print"></i> Imprimir reporte</a>
        </div>

    </form>
</div>
