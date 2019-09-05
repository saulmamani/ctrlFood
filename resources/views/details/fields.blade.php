<!-- Precio Field -->
<div class="form-group col-sm-6">
    {!! Form::label('precio', 'Precio:') !!}
    {!! Form::number('precio', null, ['class' => 'form-control']) !!}
</div>

<!-- Cantidad Field -->
<div class="form-group col-sm-6">
    {!! Form::label('cantidad', 'Cantidad:') !!}
    {!! Form::number('cantidad', null, ['class' => 'form-control']) !!}
</div>

<!-- Sales Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('sales_id', 'Sales Id:') !!}
    {!! Form::number('sales_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Products Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('products_id', 'Products Id:') !!}
    {!! Form::number('products_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('details.index') !!}" class="btn btn-default">Cancel</a>
</div>
