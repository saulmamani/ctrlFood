<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $client->id !!}</p>
</div>

<!-- Nit Field -->
<div class="form-group">
    {!! Form::label('nit', 'Nit:') !!}
    <p>{!! $client->nit !!}</p>
</div>

<!-- Razon Social Field -->
<div class="form-group">
    {!! Form::label('razon_social', 'Razon Social:') !!}
    <p>{!! $client->razon_social !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $client->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $client->updated_at !!}</p>
</div>

