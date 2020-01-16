<div class="col-sm-8">
    <!-- Categoria Field -->
    <div class="form-group col-sm-12">
        {!! Form::label('categoria', 'Categoría: *') !!}
        {!! Form::select('categoria', \App\Patrones\Fachada::categoriasProducto() ,null, ['class' => 'form-control', 'required']) !!}
    </div>

    <!-- Nombre Field -->
    <div class="form-group col-sm-8">
        {!! Form::label('nombre', 'Nombre: *') !!}
        {!! Form::text('nombre', null, ['class' => 'form-control', 'required']) !!}
    </div>

    <!-- Precio Field -->
    <div class="form-group col-sm-4">
        {!! Form::label('precio', 'Precio: [Bs] *') !!}
        {!! Form::number('precio', null, ['class' => 'form-control', 'required', 'min'=>'1', 'max'=>'5000', 'step'=>'any']) !!}
    </div>
</div>

<div class="col-sm-4">
    <!-- Imagen Field -->
    <div class="thumbnail">
        @if(isset($product) && isset($product->fotografia))
            <img id="img_destino" src="{{ asset('/images_products/'.$product->fotografia) }}" alt="foto">
        @else
            <img id="img_destino" src="{{ asset('/images_products/imagen_base.png') }}" alt="foto">
        @endif

        <div class="caption text-center">
            <div class="foto_boton file btn btn-lg btn-primary">
                <i class="glyphicon glyphicon-paperclip"></i> Cargar Imagen
                <input id="foto_input" class="foto_input" type="file" name="foto_input" accept="image/*"/>
            </div>
        </div>
    </div>
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('products.index') !!}" class="btn btn-default">Cancelar</a>
</div>
