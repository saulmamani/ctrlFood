@extends('layouts.app')

@section('content')
    <section class="content-header">
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>

        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('users.show_fields')
                    @if(\App\Patrones\Permiso::esAdministrador())
                        <a href="{!! route('users.index') !!}" class="btn btn-default">Volver</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
