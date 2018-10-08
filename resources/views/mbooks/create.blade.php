@extends('layouts.app')

@section('content')

<div class="container">

<h1>Agregar un Libro</h1>
<p class="lead">Especificar los datos del nuevo libro.</p>

<hr>

@include('layouts.subview_form_errors')

{!! Form::open(['route' => 'mbooks.store']) !!}

@include('mbooks.subview_form_elements')

{!! Form::submit('Crear', ['class' => 'btn btn-primary']) !!}
<a href="{{ request()->headers->get('referer') }}" class="btn btn-secondary">Cancelar</a>

{!! Form::close() !!}

</div>

@stop