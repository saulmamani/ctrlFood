@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Ventas realizadas</h1>
        <h1 class="pull-right">
            <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px"
               href="{!! route('sales.create') !!}">Nueva venta</a>
        </h1>
    </section>
    <div class="content" id="appSales">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                @include('sales.search_form')
                @include('sales.table')
            </div>
        </div>
        <div class="text-center">

        </div>
    </div>
@endsection

@section('scripts')
    <script>
        appSales = new Vue({
            el: "#appSales",
            data:{
                isReport: false
            },
            methods:{
                print_report(route){
                    var url = "{{ url('ruta') }}".replace('ruta', route);
                    $("#frmSearch").attr("action", url).submit();
                    this.isReport = true;
                }
            }
        });
    </script>
@endsection

