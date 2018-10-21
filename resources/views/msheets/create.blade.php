@extends('layouts.app')

@section('content')

<div class="container">

@include('layouts.subview_breadcrumbs') 

<br>

<h1>Agregar una página</h1>
<p class="lead">
    Especificar los datos de la nueva página de la sección.
</p>

<br>

@include('layouts.subview_form_errors')

{!! Form::open(['route' => ['mbooks.msections.msheets.store', $mbook, $msection]]) !!}

@include('msheets.subview_form_elements')

<br>

<button type="submit" class="btn btn-primary"><i class='fas fa-plus'></i> Crear</button>
<a href="{{ request()->headers->get('referer') }}" class="btn btn-secondary">Cancelar</a>

{!! Form::close() !!}

</div>

<br>

@stop