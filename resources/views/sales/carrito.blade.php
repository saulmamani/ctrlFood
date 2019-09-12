{{-- Detalle de la venta --}}
<div class="form-group col-sm-12">
    <table class="table table-responsive table-striped">
        <thead>
        <tr>
            <th>Cant.</th>
            <th>Descripción</th>
            <th>Precio Unitario</th>
            <th>Sub Total</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <tr v-for='(row, index) in carrito' :key='index'>
            <td><input type="number" class="form-control" min="1" max="100" required v-model="row.cantidad" @change='controlarStock(row)'></td>
            <td>@{{ row.nombre }}</td>
            <td>@{{ row.precio }}</td>
            <td class="text-right">@{{ Math.round((row.precio * row.cantidad) * 100) / 100 }}</td>
            <td><button class="btn btn-xs btn-danger" title="Eliminar" @click="eliminarItemCarrito(row, index)"><i class="glyphicon glyphicon-trash"></i></button></td>
        </tr>
        <tr>
            <td colspan="3" class="text-right"><strong>Total [Bs]:</strong></td>
            <td class="text-right"><strong> @{{Math.round(sumaTotal*100)/100}}</strong></td>
        </tr>
        </tbody>
    </table>
</div>
