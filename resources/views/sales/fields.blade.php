<!-- Razon Social Cliente Field -->
@include('clients.fields')

<!-- Concepto Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('concepto', 'Concepto:') !!}
    {!! Form::text('concepto', null, ['class' => 'form-control', 'required']) !!}
    <hr>
</div>

{!! Form::hidden('nit', null, ['class' => 'form-control', 'id'=>'nit_ci_cliente']) !!}
{!! Form::hidden('razon_social', null, ['class' => 'form-control', 'id'=>'razon_social_cliente']) !!}
{!! Form::hidden('cliente_id', null, ['class' => 'form-control', 'id'=>'cliente_id']) !!}

@include('sales.carrito')


<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Finalizar venta e imprimir recibo', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('sales.index') !!}" class="btn btn-default" onclick="return confirm('Seguro que quieres cancelar esta venta\nLos cambios realizados no se guardarán')">Cancelar</a>
</div>
