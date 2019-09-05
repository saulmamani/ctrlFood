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
{{--                        @include('venta_repuestos.lista_repuestos')--}}
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

        @include('sales.nuevo_cliente')
    </div>
@endsection

@section('scripts')
    <script>
        appVenta = new Vue({
            el: "#appVenta",
            data:{
                repuestos: [],
                clientes: [],
                carrito: [],
                cliente_seleccionado: [],
                txtBuscar: '',
                esClienteNatural: true
            },
            mounted() {
                this.getRepuestos();
                this.getClientes();
            },
            methods: {
                getRepuestos(){
                    let url = "{{ url('repuestos_listar') }}";
                    axios.get(url).then(res => {
                        this.repuestos = res.data;
                    })
                },
                getClientes(){
                    this.clientes = null;
                    let url = "{{ url('clientes_listar') }}";
                    axios.get(url).then(res => {
                        this.clientes = res.data;
                    })
                },
                agregarCarrito(repuesto, index)
                {
                    if(parseInt(repuesto.stock) > 0)
                    {
                        //buscando elemento en el carrito
                        if(this.buscarItemCarrito(repuesto).length > 0)
                            toastr.error('ya añadió el repuesto al carrito con anterioridad');
                        else
                        {
                            this.carrito.push({...repuesto,...{'cantidad': 1}});
                        }
                    }
                    else
                        toastr.error('No hay cantidad disponible para la venta');
                },
                buscarItemCarrito(row)
                {
                    return this.carrito.filter(item => {
                        return item.id == row.id;
                    })
                },
                controlarStock(row)
                {
                    if(row.cantidad > row.stock || row.cantidad <= 0)
                    {
                        toastr.error('No puede registrar cantidades menores a cero o mayores al stock disponible');
                        row.cantidad = row.cantidad <= 0 ? 1 : row.cantidad > row.stock ? row.stock : row.cantidad;
                    }
                },
                eliminarItemCarrito(row, index)
                {
                    if(confirm('Seguro que quiere eliminar el registro?'))
                    {
                        this.carrito.splice(index, 1);
                        toastr.success('El repuesto se ha eliminicado del carrito de ventas y se ha restablecido en la lista de repuestos');
                    }
                },
                guardarCliente()
                {
                    let form = document.getElementById('frmCliente');
                    let datos =  new FormData(form);
                    axios({
                        method: form.getAttribute('method'),
                        url: form.getAttribute('action'),
                        data: datos,
                    }).then(response => {
                        if(response.data === "Ok")
                        {
                            form.reset();
                            $("#modalCliente").modal('hide');
                            toastr.success("Registrado correctamente correctamente!");

                            $('#cmbClientes').val(null).trigger('change');
                            this.getClientes();
                        }
                        else
                        {
                            alert(formarListaDeErrores(response.data));
                        }
                    }).catch(error => {
                        alert(formarListaDeErrores(error.response.data.errors));
                    });
                },
                finalizarVenta()
                {
                    if(confirm("Seguro que quire finalizar la venta?"))
                    {
                        if(this.carrito.length <= 0)
                            toastr.error('Error! Seleccione por lo menos repuesto para la venta');
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
                                    this.guardar_detalle(response.data.venta);
                                }
                                else
                                {
                                    alert(formarListaDeErrores(response.data));
                                }
                            }).catch(error => {
                                alert(formarListaDeErrores(error.response.data));
                            });
                        }
                    }
                },
                guardar_detalle(venta)
                {
                    let url = "{{ url('detalleVentas') }}";
                    let url_p = "{{ url('ventaRepuestos/pid') }}".replace('pid', venta.id);
                    axios.post(url, {venta_id:venta.id, carrito:this.carrito}).then(response => {
                        if(response.data === "Ok")
                        {
                            toastr.success('Venta registrada correctamente');
                            this.carrito = null;
                            window.location.href = url_p;
                        }
                        else
                        {
                            alert(formarListaDeErrores(response.data));
                        }
                    }).catch(error => {
                        let url = "{{ url('ventaRepuestos_eliminar/pid') }}".replace('pid', venta.id);
                        axios.delete(url);
                        alert(formarListaDeErrores(error.response.data));
                    });
                },
            },
            computed: {
                buscarRepuestos(){
                    return this.repuestos.filter(item => {
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

        $('#cmbClientes').on('select2:select', function (e) {
            var data = e.params.data;
            let row = appVenta.clientes[data.id];
            $("#nit_ci_cliente").val(row.nit_ci);
            $("#razon_social_cliente").val(row.razon_social);
            $("#cliente_id").val(row.id);
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
