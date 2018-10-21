@extends('layouts.app')

@section('content')

<div class="container">

@include('layouts.subview_breadcrumbs') 

<br>

<h1>Editar una Sección</h1>
<p class="lead">Especificar los nuevos datos de la sección.</p>

<br>

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

<button type="submit" class="btn btn-warning"><i class='fas fa-pencil-alt'></i> Editar</button>
<a href="{{ request()->headers->get('referer') }}" class="btn btn-secondary">Cancelar</a>

{!! Form::close() !!}

</div>

@stop