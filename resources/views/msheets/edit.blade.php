@extends('layouts.app')

@section('content')

<div class="container">

@include('layouts.subview_breadcrumbs') 

<br>

<h1>Editar una Página</h1>
<p class="lead">Especificar los nuevos datos de la página.</p>

<br>

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

<button type="submit" class="btn btn-warning"><i class='fas fa-pencil-alt'></i> Editar</button>
<a href="{{ request()->headers->get('referer') }}" class="btn btn-secondary">Cancelar</a>

{!! Form::close() !!}

</div>

<br>

@stop