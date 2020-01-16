<div class="table-responsive">
    <table class="table" id="users-table">
        <thead>
        <tr>
            <th>Email</th>
            <th>Rol</th>
            <th>Nombre</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td>{{ $user->email }}</td>
                <td>{{ $user->rol }}</td>
                <td>{{ $user->name }}</td>
                <td>
                    {{ Form::open(['route' => ['users.destroy', $user->id], 'method' => 'delete']) }}
                    <div class='btn-group'>
                        @if(\App\Patrones\Permiso::esAdministrador() && $user->email != Auth::user()->email)
                            <a href="{{ route('users.show', [$user->id]) }}" title="Perfil"
                               class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                            <a href="{{ route('users.edit', [$user->id]) }}" title="Modificar"
                               class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                            {{ Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'title'=>'Dar de baja', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Esta seguro que quieres eliminar este usuario?')"]) }}
                        @endif

                    </div>
                    {{ Form::close() }}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
