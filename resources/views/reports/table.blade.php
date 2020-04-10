<div>
    <table class="mytable" id="sales-table">
        <thead>
        <tr>
            <th>Número <br> de Ticket</th>
            <th>Fecha</th>
            <th>Cliente</th>
            <th>Total [Bs]</th>
            <th>Registrado <br>por</th>
        </tr>
        </thead>
        <tbody>
        @php
            $total = 0;
        @endphp
        @foreach($sales as $sale)
            <tr>
                <td class="center"><strong>{!! $sale->numero_ticket !!}</strong></td>
                <td style="width:100px">{!! date('d/m/Y H:i:s', strtotime($sale->fecha)) !!}</td>
                <td style="width: 300px">
                    {!! $sale->clients->razon_social !!} <br>
                    <small>Nit: {!! $sale->clients->nit!!}</small>
                </td>
                <td class="right"><strong>{{ $sale->total }}</strong></td>
                <td><span class="text-muted">{!! $sale->users->email !!}</span></td>
            </tr>
            @php
                $total += $sale->total;
            @endphp
        @endforeach
        </tbody>
    </table>
</div>

<div class="col-sm-12 text-right">
    <h3><strong>Total vendido [Bs]: {{ round($total, 2) }}</strong></h3>
</div>
