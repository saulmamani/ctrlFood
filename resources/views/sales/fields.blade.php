<!-- Razon Social Cliente Field -->
<div class="form-group col-sm-12">
    <div class="input-group">
        {!! Form::label('cmbClientes', 'Razón Social o Cliente:') !!}

        <select id="cmbClientes" class="form-control select2" name="cmbClientes" autocomplete="off" required>
            <option  value="">Seleccione un Cliente...</option>
            <option  v-for='(row, index) in clientes' :value='index' :key='index'>@{{ row.informacion_completa }}</option>
        </select>

        <div class="input-group-btn" style="padding-top: 25px">
            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modalCliente" >Nuevo cliente</button>
        </div>
    </div>
</div>

<!-- Concepto Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('concepto', 'Concepto:') !!}
    {!! Form::text('concepto', null, ['class' => 'form-control', 'required']) !!}
    <hr>
</div>

{!! Form::hidden('nit', null, ['class' => 'form-control', 'id'=>'nit_ci_cliente']) !!}
{!! Form::hidden('razon_social', null, ['class' => 'form-control', 'id'=>'razon_social_cliente']) !!}
{!! Form::hidden('cliente_id', null, ['class' => 'form-control', 'id'=>'cliente_id']) !!}

{{--@include('venta_repuestos.lista_detalle')--}}


<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Finalizar venta e imprimir recibo', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('sales.index') !!}" class="btn btn-default" onclick="return confirm('Seguro que quieres cancelar esta venta\nLos cambios realizados no se guardarán')">Cancelar</a>
</div>
