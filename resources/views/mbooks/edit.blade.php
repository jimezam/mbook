@extends('layouts.app')

@section('content')

<div class="container">

@include('layouts.subview_breadcrumbs') 

<h1>Editar un Libro</h1>
<p class="lead">Especificar los nuevos datos del libro.</p>

@include('layouts.subview_form_errors')

{!! Form::model($mbook, [
    'method' => 'PUT',
    'route' => ['mbooks.update', $mbook->id]
]) !!}

@include('mbooks.subview_form_elements')

{!! Form::submit('Editar', ['class' => 'btn btn-info']) !!}
<a href="{{ request()->headers->get('referer') }}" class="btn btn-secondary">Cancelar</a>

{!! Form::close() !!}

</div>

@stop