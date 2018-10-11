@extends('layouts.app')

@section('content')

<div class="container">

<h1>Editar una Sección</h1>
<p class="lead">Especificar los nuevos datos de la sección.</p>

<hr>

@include('layouts.subview_form_errors')

{!! Form::model($msection, [
    'method' => 'PUT',
    'route' => ['mbooks.msections.update', $mbook, $msection]
]) !!}

<div class="form-group">
    {!! Form::label('book', 'Libro', ['class' => 'control-label']) !!}
    {!! Form::text('book', $mbook->name, ['class' => 'form-control', ' disabled' => ' disabled']) !!}
</div>

@include('msections.subview_form_elements')

{!! Form::submit('Editar', ['class' => 'btn btn-info']) !!}
<a href="{{ request()->headers->get('referer') }}" class="btn btn-secondary">Cancelar</a>

{!! Form::close() !!}

</div>

@stop