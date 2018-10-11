<!-- --------------------------------- -->

<div class="form-group">
    {!! Form::label('name', 'Nombre', ['class' => 'control-label']) !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'maxlength' => 100]) !!}
</div>

<div class="form-group">
    {!! Form::label('description', 'Descripción', ['class' => 'control-label']) !!}
    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
</div>

<!-- --------------------------------- -->
