@extends('layouts.app')

@section('content')
    <section class="content-header">
    </section>
    <div class="content" id="appSales">
        <div class="box box-primary">
            <div class="box-body">

                <!-- Custom tabs (Charts with tabs)-->
                <div class="nav-tabs-custom">
                    <!-- Tabs within a box -->
                    <ul class="nav nav-tabs pull-right">
                        <li class="active"><a href="#revenue-chart" data-toggle="tab">Reporte económico</a></li>
                        <li><a href="#sales-chart" data-toggle="tab">Reporte clientes</a></li>
                        <li class="pull-left header"><i class="fa fa-inbox"></i>Reportes estadísticos</li>
                    </ul>
                    <div class="tab-content no-padding">
                        <!-- Morris chart - Sales -->
                        <div class="chart tab-pane active" id="revenue-chart"
                             style="position: relative;">
                            <br>

                            <form action="" class="text-center">
                                Gestión:
                                <input type="number" name="txtAnio" id="txtAnio"
                                       value="{{ isset($_GET['txtAnio']) ? $_GET['txtAnio'] : date('Y') }}">
                                <button type="submit">Aceptar</button>
                            </form>
                            <hr>
                            <canvas id="canvas"></canvas>
                        </div>
                        <div class="chart tab-pane" id="sales-chart" style="position: relative;">
                            @include('reports.clientes')
                        </div>
                    </div>
                </div>
                <!-- /.nav-tabs-custom -->
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/Chart.min.js') }}"></script>
    <script src="{{ asset('js/utils.js') }}"></script>
    <script>
        var config = {
            type: 'line',
            data: {
                labels: [
                    @foreach($totales as $row)
                        '{!! $row->mes !!}',
                    @endforeach
                ],
                datasets: [{
                    label: 'Venta por comidas y bebidas',
                    backgroundColor: window.chartColors.red,
                    borderColor: window.chartColors.red,
                    data: [
                        @foreach($totales as $row)
                            '{!! $row->total !!}',
                        @endforeach
                    ],
                    fill: false,
                }, ]
            },
            options: {
                responsive: true,
                title: {
                    display: true,
                    text: 'REPORTE ECONÓMICO ESTADÍSTICO'
                },
                tooltips: {
                    mode: 'index',
                    intersect: false,
                },
                hover: {
                    mode: 'nearest',
                    intersect: true
                },
                scales: {
                    xAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: 'Meses'
                        }
                    }],
                    yAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: 'Monto [Bs]'
                        },
                        ticks: {
                            min: 0,
                            max: {{ $ymax }},

                            // forces step size to be 5 units
                            stepSize: 5
                        }
                    }]
                }
            }
        };

        window.onload = function () {
            var ctx = document.getElementById('canvas').getContext('2d');
            window.myLine = new Chart(ctx, config);
        };
    </script>
@endsection
