@extends('layouts.app')

@section('content')

<div class="container">

<h1>Editar un Libro</h1>
<p class="lead">Especificar los nuevos datos del libro.</p>

<hr>

@if($errors->any())
    <div class="alert alert-danger">
        @foreach($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif

{!! Form::model($mbook, [
    'method' => 'PUT',
    'route' => ['mbooks.update', $mbook->id]
]) !!}

<!-- --------------------------------- -->

<div class="form-group">
    {!! Form::label('category_id', 'Categoría', ['class' => 'control-label']) !!}
    {!! Form::select('category_id', $categories, null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('shortname', 'Nombre Corto', ['class' => 'control-label']) !!}
    {!! Form::text('shortname', null, ['class' => 'form-control', 'maxlength' => 13]) !!}
</div>

<div class="form-group">
    {!! Form::label('name', 'Nombre', ['class' => 'control-label']) !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'maxlength' => 100]) !!}
</div>

<div class="form-group">
    {!! Form::label('state', 'Estado', ['class' => 'control-label']) !!}
    {!! Form::select('state', $states, null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('description', 'Descripción', ['class' => 'control-label']) !!}
    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
</div>

<!-- --------------------------------- -->

{!! Form::submit('Editar', ['class' => 'btn btn-info']) !!}
<a href="{{ request()->headers->get('referer') }}" class="btn btn-secondary">Cancelar</a>

{!! Form::close() !!}

</div>

@stop