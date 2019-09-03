<!-- Categoria Field -->
<div class="form-group col-sm-6">
    {!! Form::label('categoria', 'Categoría: *') !!}
    {!! Form::text('categoria', null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Nombre Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nombre', 'Nombre: *') !!}
    {!! Form::text('nombre', null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Precio Field -->
<div class="form-group col-sm-6">
    {!! Form::label('precio', 'Precio: *') !!}
    {!! Form::number('precio', null, ['class' => 'form-control', 'required', 'min'=>'1', 'max'=>'200']) !!}
</div>

<!-- Fotografia Field -->
<div class="form-group col-sm-6">
    {!! Form::label('fotografia', 'Imagen:') !!}
    {!! Form::text('fotografia', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('products.index') !!}" class="btn btn-default">Cancelar</a>
</div>
