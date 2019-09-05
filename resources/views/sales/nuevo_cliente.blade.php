<!-- Modal -->
<div id="modalCliente" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Nuevo Cliente</h4>
            </div>
            <div class="modal-body" id="divCliente">
                {!! Form::open(['route' => 'clients.store', 'id'=>'frmCliente', '@submit.prevent' => 'guardarCliente']) !!}

{{--                    {!! Form::hidden('modal', 'Si') !!}--}}
{{--                    @include('clientes.fields')--}}
                    <!-- Submit Field -->
                    <div class="form-group col-sm-12">
                        {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
                    </div>

                {!! Form::close() !!}
            </div>
            <div class="modal-footer" style="border-top: none">
            </div>
        </div>

    </div>
</div>
