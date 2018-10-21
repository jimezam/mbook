@extends('layouts.app')

@section('content')

<div class="container">

@include('layouts.subview_breadcrumbs') 

<h1>Agregar un Libro</h1>
<p class="lead">Especificar los datos del nuevo libro.</p>

<br>

@include('layouts.subview_form_errors')

{!! Form::open(['route' => 'mbooks.store']) !!}

@include('mbooks.subview_form_elements')

<button type="submit" class="btn btn-primary"><i class='fas fa-plus'></i> Crear</button>
<a href="{{ request()->headers->get('referer') }}" class="btn btn-secondary">Cancelar</a>

{!! Form::close() !!}

</div>

<br>

@stop