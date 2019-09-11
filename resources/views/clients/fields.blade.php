<!-- Nit Field -->
<div class="form-group col-sm-12">
    {!! Form::label('nit', 'Nit: *') !!}
    {!! Form::text('nit', null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Razon Social Field -->
<div class="form-group col-sm-12">
    {!! Form::label('razon_social', 'Razón Social: *') !!}
    {!! Form::text('razon_social', null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('clients.index') !!}" class="btn btn-default">Cancelar</a>
</div>
