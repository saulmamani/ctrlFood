@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Nueva Venta
        </h1>
    </section>
    <div class="content" id="appVenta">

        <div class="row">
            <div class="col-md-6">
                <div class="box box-danger">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="glyphicon glyphicon-list"></i> Productos</h3>
                    </div>
                    <div class="box-body">
                        @include('sales.product_list')
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                @include('adminlte-templates::common.errors')
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="glyphicon glyphicon-shopping-cart"></i> Carrito de venta</h3>
                        <span class="pull-right">Fecha: {{ date('d/m/Y') }}</span>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            {!! Form::open(['route' => 'sales.store', 'id'=>'frmVenta', '@submit.prevent'=>'finalizarVenta()']) !!}
                                @include('sales.fields')
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        appVenta = new Vue({
            el: "#appVenta",
            data:{
                products: [],
                clientes: [],
                carrito: [],
                txtBuscar: '',
            },
            mounted() {
                this.getProductos();
            },
            methods: {
                getProductos(){
                    let url = "{{ url('product_list') }}";
                    axios.get(url).then(res => {
                        this.products = res.data;
                    })
                },
                getClientes(e){
                    let nit = e.target.value;
                    this.clientes = [];
                    if($.trim(nit) === "")
                        return;

                    let url = "{{ url('clients_list/pnit') }}".replace('pnit', nit);
                    axios.get(url).then(res => {
                        this.clientes = res.data;

                        if(this.clientes.length <= 0 || this.clientes.nit == 0) {
                            $("#razon_social").val("");
                            $("#clients_id").val("");
                            $("#razon_social").removeAttr('readonly');
                        }
                        else {
                                $("#razon_social").val(this.clientes.razon_social);
                                $("#razon_social").attr('readonly', 'readonly');
                                $("#clients_id").val(this.clientes.id);
                        }
                    });
                },
                agregarCarrito(product, index)
                {
                    //buscando elemento en el carrito
                    if(this.buscarItemCarrito(product).length > 0)
                        toastr.error('ya añadió el producto al carrito con anterioridad');
                    else
                    {
                        this.carrito.push({...product,...{'cantidad': 1}});
                    }
                },
                buscarItemCarrito(row)
                {
                    return this.carrito.filter(item => {
                        return item.id == row.id;
                    })
                },
                controlarStock(row)
                {
                    if(row.cantidad <= 0)
                    {
                        toastr.error('No puede registrar cantidades menores a cero');
                        row.cantidad = 1;
                    }
                },
                eliminarItemCarrito(row, index)
                {
                    if(confirm('Seguro que quiere eliminar el registro?'))
                    {
                        this.carrito.splice(index, 1);
                        toastr.success('El producto se ha eliminicado del carrito de ventas');
                    }
                },
                finalizarVenta()
                {
                    if($.trim($('#nit').val()) === "")
                    {
                        toastr.error("escriba el nit del cliente");
                        return;
                    }

                    if(confirm("Seguro que quire finalizar la venta?"))
                    {
                        if(this.carrito.length <= 0)
                            toastr.error('Error! Seleccione por lo menos un producto para la venta');
                        else
                        {
                            let form = document.getElementById('frmVenta');
                            let datos =  new FormData(form);
                            axios({
                                method: form.getAttribute('method'),
                                url: form.getAttribute('action'),
                                data: datos,
                            }).then(response => {
                                if(response.data.res === "Ok")
                                {
                                    this.guardar_detalle(response.data.sale);
                                }
                                else
                                {
                                    alert(formarListaDeErrores(response.data.errors));
                                }
                            }).catch(error => {
                                alert(formarListaDeErrores(error.response.data.errors));
                            });
                        }
                    }
                },
                guardar_detalle(sale)
                {
                    let url = "{{ url('details') }}";
                    let url_p = "{{ url('sales/pid') }}".replace('pid', sale.id);
                    axios.post(url, {sale_id:sale.id, carrito:this.carrito}).then(response => {
                        if(response.data === "Ok")
                        {
                            toastr.success('Venta registrada correctamente');
                            this.carrito = [];
                            window.location.href = url_p;
                        }
                        else
                        {
                            alert(formarListaDeErrores(response.data));
                        }
                    }).catch(error => {
                        let url = "{{ url('sale_delete/pid') }}".replace('pid', sale.id);
                        axios.delete(url);
                        alert(formarListaDeErrores(error.response.data.errors));
                    });
                },
            },
            computed: {
                buscarProductos(){
                    return this.products.filter(item => {
                        return item.nombre.toLowerCase().includes(this.txtBuscar.toLowerCase());
                    })
                },
                sumaTotal(){
                    let total = 0;
                    this.carrito.map(dato => {
                        total += parseFloat(dato.precio * dato.cantidad);
                    });
                    return total;
                }
            },
        });

        function askConfirmation (evt) {
            if(appVenta.carrito.length > 0)
            {
                var msg = 'Si recarga la página perderá todos los datos ingresados.\n¿Deseas recargar la página?';
                evt.returnValue = msg;
                return msg;
            }
        }
        window.addEventListener('beforeunload', askConfirmation);
    </script>
@endsection
