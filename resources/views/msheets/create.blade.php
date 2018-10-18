@extends('layouts.app')

@section('content')

<div class="container">

@include('layouts.subview_breadcrumbs') 

<h1>Agregar una página</h1>
<p class="lead">
    Especificar los datos de la nueva página de la sección <span class="h4">"{{ $msection->name }}"</span> 
    del libro <span class="h4">"{{ $mbook->name }}"</span>.
</p>

@include('layouts.subview_form_errors')

{!! Form::open(['route' => ['mbooks.msections.msheets.store', $mbook, $msection]]) !!}

@include('msheets.subview_form_elements')

<br>

{!! Form::submit('Crear', ['class' => 'btn btn-primary']) !!}
<a href="{{ request()->headers->get('referer') }}" class="btn btn-secondary">Cancelar</a>

{!! Form::close() !!}

</div>

@stop