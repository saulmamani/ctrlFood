<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $product->id !!}</p>
</div>

<!-- Categoria Field -->
<div class="form-group">
    {!! Form::label('categoria', 'Categoria:') !!}
    <p>{!! $product->categoria !!}</p>
</div>

<!-- Nombre Field -->
<div class="form-group">
    {!! Form::label('nombre', 'Nombre:') !!}
    <p>{!! $product->nombre !!}</p>
</div>

<!-- Precio Field -->
<div class="form-group">
    {!! Form::label('precio', 'Precio:') !!}
    <p>{!! $product->precio !!}</p>
</div>

<!-- Fotografia Field -->
<div class="form-group">
    {!! Form::label('fotografia', 'Fotografia:') !!}
    <p>{!! $product->fotografia !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $product->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $product->updated_at !!}</p>
</div>

