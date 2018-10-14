@extends('layouts.app')

@section('content')

<div class="container">

<h1>Editar una Página</h1>
<p class="lead">Especificar los nuevos datos de la página.</p>

<hr>

@include('layouts.subview_form_errors')

{!! Form::model($msheet, [
    'method' => 'PUT',
    'route' => ['mbooks.msections.msheets.update', $mbook, $msection, $msheet]
]) !!}

<div class="form-group">
    {!! Form::label('book', 'Libro', ['class' => 'control-label']) !!}
    {!! Form::text('book', $mbook->name, ['class' => 'form-control', ' disabled' => ' disabled']) !!}
</div>

<div class="form-group">
    {!! Form::label('section', 'Sección', ['class' => 'control-label']) !!}
    {!! Form::text('section', $msection->name, ['class' => 'form-control', ' disabled' => ' disabled']) !!}
</div>

@include('msheets.subview_form_elements')

{!! Form::submit('Editar', ['class' => 'btn btn-info']) !!}
<a href="{{ request()->headers->get('referer') }}" class="btn btn-secondary">Cancelar</a>

{!! Form::close() !!}

</div>

@stop