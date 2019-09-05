<div class="table-responsive">
    <table class="table" id="sales-table">
        <thead>
            <tr>
                <th>Fecha</th>
        <th>Concepto</th>
        <th>Nit</th>
        <th>Razon Social</th>
        <th>Estado</th>
        <th>Users Id</th>
        <th>Clients Id</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($sales as $sale)
            <tr>
                <td>{!! $sale->fecha !!}</td>
            <td>{!! $sale->concepto !!}</td>
            <td>{!! $sale->nit !!}</td>
            <td>{!! $sale->razon_social !!}</td>
            <td>{!! $sale->estado !!}</td>
            <td>{!! $sale->users_id !!}</td>
            <td>{!! $sale->clients_id !!}</td>
                <td>
                    {!! Form::open(['route' => ['sales.destroy', $sale->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! route('sales.show', [$sale->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{!! route('sales.edit', [$sale->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
