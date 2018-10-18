@extends('layouts.app')

@section('content')

<div class="container">

@include('layouts.subview_breadcrumbs') 

<h1>Agregar una sección</h1>
<p class="lead">Especificar los datos de la nueva sección del libro <span class="h4">"{{ $mbook->name }}"</span>.</p>

@include('layouts.subview_form_errors')

{!! Form::open(['route' => ['mbooks.msections.store', $mbook->id]]) !!}

@include('msections.subview_form_elements')

{!! Form::submit('Crear', ['class' => 'btn btn-primary']) !!}
<a href="{{ request()->headers->get('referer') }}" class="btn btn-secondary">Cancelar</a>

{!! Form::close() !!}

</div>

@stop