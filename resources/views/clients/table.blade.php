<div class="table-responsive">
    <table class="table" id="clients-table">
        <thead>
            <tr>
                <th>Nit</th>
                <th>Razón Social</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        @foreach($clients as $client)
            <tr>
                <td>{{ $client->nit }}</td>
                <td>{{ $client->razon_social }}</td>
                <td>
                    {{ Form::open(['route' => ['clients.destroy', $client->id], 'method' => 'delete']) }}
                    <div class='btn-group'>
                        <a href="{{ route('clients.edit', [$client->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {{ Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) }}
                    </div>
                    {{ Form::close() }}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
