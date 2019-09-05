<div class="table-responsive">
    <table class="table" id="details-table">
        <thead>
            <tr>
                <th>Precio</th>
        <th>Cantidad</th>
        <th>Sales Id</th>
        <th>Products Id</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($details as $detail)
            <tr>
                <td>{!! $detail->precio !!}</td>
            <td>{!! $detail->cantidad !!}</td>
            <td>{!! $detail->sales_id !!}</td>
            <td>{!! $detail->products_id !!}</td>
                <td>
                    {!! Form::open(['route' => ['details.destroy', $detail->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! route('details.show', [$detail->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{!! route('details.edit', [$detail->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
