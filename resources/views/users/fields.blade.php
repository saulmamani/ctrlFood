<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Nombre: *') !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email', 'Email:*') !!}
    {!! Form::email('email', null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Password Field -->
<div class="form-group col-sm-6">
    {!! Form::label('password', 'Password: *') !!}
    {!! Form::password('password', ['class' => 'form-control', 'required']) !!}
</div>

<!-- Rol Field -->
<div class="form-group col-sm-6">
    {!! Form::label('rol', 'Rol: *') !!}
    {!! Form::text('rol', null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Fotografia Field -->
<div class="form-group col-sm-6">
    {!! Form::label('fotografia', 'Imagen:') !!}
    {!! Form::text('fotografia', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('users.index') !!}" class="btn btn-default">Cancelar</a>
</div>
