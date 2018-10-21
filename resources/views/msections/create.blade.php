@extends('layouts.app')

@section('content')

<div class="container">

@include('layouts.subview_breadcrumbs') 

<h1>Agregar una sección</h1>
<p class="lead">Especificar los datos de la nueva sección del libro.</p>

@include('layouts.subview_form_errors')

{!! Form::open(['route' => ['mbooks.msections.store', $mbook->id]]) !!}

@include('msections.subview_form_elements')

<button type="submit" class="btn btn-primary"><i class='fas fa-plus'></i> Crear</button>
<a href="{{ request()->headers->get('referer') }}" class="btn btn-secondary">Cancelar</a>

{!! Form::close() !!}

</div>

@stop