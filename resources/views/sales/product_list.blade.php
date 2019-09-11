<p>
    <input type="text" class="form-control" id="txtBuscar" v-model='txtBuscar' placeholder="Buscar por nombre">
</p>
<ul class="products-list product-list-in-box">
    <li class="item" v-for='(row, index) in buscarProductos' :key='row.id' :data-index='index' >
        <div class="product-img">
            <img :src='/images_products/ + row.fotografia' alt="Product Image">
        </div>
        <div class="product-info">
            <a href="javascript:void(0)" class="product-title">@{{ row.nombre }}</a>

            <span class="fa-pull-right" style="margin-left: 10px;">
                <button class="btn btn-success btn-sm" @click='agregarCarrito(row, row.id)'><i class="glyphicon glyphicon-chevron-right"></i>Añadir </button>
            </span>
            <span class="label label-danger pull-right">Bs. @{{ row.precio }}</span>

            <span class="product-description">
                @{{ row.categoria }}
            </span>
        </div>
    </li>
</ul>
