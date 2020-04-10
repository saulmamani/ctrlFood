<div class="row">
    <div class="col-sm-8">

        <!-- Email Field -->
        <div class="form-group col-sm-6">
            {!! Form::label('email', 'Email: *') !!}
            {!! Form::email('email', null, ['class' => 'form-control', 'required']) !!}
        </div>

        <!-- Password Field -->
        <div class="form-group col-sm-6">
            {!! Form::label('password', 'Password: *') !!}
            {!! Form::password('password', ['class' => 'form-control', 'required']) !!}
        </div>

         <!-- Rol Field -->
        <div class="form-group col-sm-12">
            {!! Form::label('rol', 'Rol: *') !!}
            {!! Form::select('rol', \App\Patrones\Fachada::roles() ,null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group col-sm-12">
            <hr>
        </div>

        <!-- Nombre Field -->
        <div class="form-group col-sm-12">
            {!! Form::label('name', 'Nombre completo: *') !!}
            {!! Form::text('name', null, ['class' => 'form-control', 'required']) !!}
        </div>

    </div>

    <div class="col-sm-4">

        <!-- Fotografia Field -->
            <div class="thumbnail">
                    @if(isset($user) && isset($user->fotografia))
                        <img id="img_destino" src="{{ asset('/images_user/'.$user->fotografia) }}" alt="foto">
                    @else
                        <img id="img_destino" src="{{ asset('/images_user/foto_base.png') }}" alt="foto">
                    @endif

                    <div class="caption text-center">
                        <div class="foto_boton file btn btn-lg btn-primary">
                            <i class="glyphicon glyphicon-paperclip"></i> Cargar Fotografía
                            <input id="foto_input" class="foto_input" type="file" name="foto_input" accept="image/*" />
                        </div>
                    </div>
            </div>
    </div>

</div>
<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('users.index') !!}" class="btn btn-default">Cancelar</a>
</div>
