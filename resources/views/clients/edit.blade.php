@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Editar Cliente
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($client, ['route' => ['clients.update', $client->id], 'method' => 'patch']) !!}

                        @include('clients.fields')

                        <!-- Submit Field -->
                       <div class="form-group col-sm-12">
                           {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
                           <a href="{!! route('clients.index') !!}" class="btn btn-default">Cancelar</a>
                       </div>


                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection
