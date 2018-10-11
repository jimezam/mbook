@extends('layouts.app')

@section('content')

<div class="container">

<h1>Listar Secciones</h1>
<p class="lead">Listado de las secciones del libro <span class="h4">"{{ $mbook->name }}"</span>.</p>
<p>
    <a href="{!! route('mbooks.msections.create', $mbook->id) !!}" class="btn btn-primary">Agregar</a>
    <a href="{{ route('mbooks.index') }}" class="btn btn-info" style="margin-right: 5px; float:left">Volver</a>
</p>

<div id="items-list" style="padding-top: 5px;">

@forelse($msections as $msection)
    <div class="card" style="margin-bottom: 5px;">
        <div class="card-body">
            <h5 class="card-title">{{ $msection->name }}</h5>
            <h6 class="card-subtitle mb-2 text-muted"></h6>
            <p class="card-text">
                
            </p>
            <a href="{{ route('mbooks.msections.msheets.index', [$mbook, $msection]) }}" class="btn btn-success btn-sm" style="margin-right: 5px; float:left">Contenidos</a>
            <a href="{{ route('mbooks.msections.show', [$mbook, $msection]) }}" class="btn btn-info btn-sm" style="margin-right: 5px; float:left">Ver</a>
            <a href="{{ route('mbooks.msections.edit', [$mbook, $msection]) }}" class="btn btn-warning btn-sm" style="margin-right: 5px; float:left">Editar</a>
            {!! Form::open([
                'method' => 'DELETE',
                'route' => ['mbooks.msections.destroy', $mbook, $msection],
                'style' => 'float:left',
                'onsubmit' => 'return confirm("¿Está seguro de remover este elemento?")'
            ]) !!}
                {!! Form::submit('Remover', ['class' => 'btn btn-danger btn-sm', 'style' => "margin-right: 5px; float:left"]) !!}
            {!! Form::close() !!}
            <a href="xxx" class="btn btn-secondary btn-sm" style="margin-right: 5px; float:left">Subir</a>
            <a href="xxx" class="btn btn-secondary btn-sm" style="margin-right: 5px; float:left">Bajar</a>
        </div>
    </div>

@empty

    <div class="alert alert-info" role="alert">
        No hay registros que mostrar.
    </div>

@endforelse

</div>

{{ $msections->links() }}

<br>

<p>
<a href="{{ route('mbooks.index') }}" class="btn btn-info" style="margin-right: 5px; float:left">Volver</a>
</p>

</div>

@stop