<div class="content">
    <div class="row">
        <div class="col-sm-8 col-md-8 col-md-offset-2 col-sm-offset-2">
            <h4 class="text-center">Top clientes potenciales</h4>
            <hr>

            <table class="table table-striped table-bordered">
                <tr>
                    <th>#</th>
                    <th>Razón Social</th>
                    <th>Total Consumido [Bs]</th>
                </tr>
                @php
                    $nro = 1;
                @endphp

                @foreach($clientes as $row)
                    <tr>
                        <td><strong>{!! $nro++ !!}</strong></td>
                        <td>{!! $row->razon_social !!}</td>
                        <td>{!! $row->total !!}</td>
                    </tr>
                @endforeach
            </table>

        </div>
    </div>
</div>
