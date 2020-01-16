<div class="row">

    <div class="col-md-3">

        {!! Form::model($user, ['route' => ['users.update_foto', $user->id], 'method' => 'put', 'files'=>true]) !!}
        <!-- Foto Field -->
        <div class="thumbnail">
            @if(isset($user) && isset($user->fotografia))
                <img id="img_destino" src="{{ asset('/images_user/'.$user->fotografia) }}" alt="foto">
            @else
                <img id="img_destino" src="{{ asset('images_user/foto_base.png') }}" alt="foto">
            @endif

            <div class="caption text-center">
                <div class="foto_boton file btn btn-lg btn-primary">
                    <i class="glyphicon glyphicon-paperclip"></i> Cargar Fotografía
                    <input id="foto_input" class="foto_input" type="file" name="foto_input" accept="image/*" />
                </div>
            </div>
        </div>

        <!-- Submit Field -->
        <div class="form-group col-md-12 text-center">
            {!! Form::submit('Cambiar Foto de perfil', ['class' => 'btn btn-success']) !!}
        </div>
        {!! Form::close() !!}

    </div>

    <div class="col-md-4">
        <h4>Mi Perfil</h4>
        <hr>

        <!-- Name Field -->
        <div class="form-group">
            {!! Form::label('name', 'Nombre Completo:') !!}
            <p>{{ $user->name }}</p>
        </div>

        <!-- Email Field -->
        <div class="form-group">
            {!! Form::label('email', 'Cuenta:') !!}
            <p>{{ $user->email }}</p>
        </div>

        <!-- Rol Field -->
        <div class="form-group">
            {!! Form::label('rol', 'Rol:') !!}
            <p>{{ $user->rol }}</p>
        </div>
    </div>

    <div class="col-md-5">
        <h4>Cambiar Contraseña</h4>
        <hr>

        @include('adminlte-templates::common.errors')

        @include('users.password_fields')

    </div>

</div>
