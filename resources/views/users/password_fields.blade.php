{!! Form::model($user, ['route' => ['users.update_password', $user->id], 'method' => 'put']) !!}

    <!-- Password Field -->
    <div class="form-group col-sm-12">
        {!! Form::label('old_password', 'Password actual:') !!}
        {!! Form::password('old_password', ['class' => 'form-control', 'required', 'minlength'=>'5', 'maxlength'=>'20']) !!}
    </div>

    <div class="col-sm-12"><hr></div>

    <!-- Password Field -->
    <div class="form-group col-sm-12">
        {!! Form::label('password', 'Password:') !!}
        {!! Form::password('password', ['class' => 'form-control', 'required', 'minlength'=>'5', 'maxlength'=>'20']) !!}
    </div>

    <!-- Password Field -->
    <div class="form-group col-sm-12">
        {!! Form::label('password', 'Nuevo Password:') !!}
        {!! Form::password('password_confirmation', ['class' => 'form-control', 'required', 'minlength'=>'5', 'maxlength'=>'20']) !!}
    </div>

    <!-- Submit Field -->
    <div class="form-group col-sm-12 text-right">
        {!! Form::submit('Cambiar Contraseña', ['class' => 'btn btn-success']) !!}
    </div>
{!! Form::close() !!}
