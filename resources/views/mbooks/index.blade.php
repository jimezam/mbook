@extends('layouts.app')

@section('content')

<div class="container">

<h1>Listar libros</h1>
<p class="lead">Listado de todos los libros escritos por ti.</p>
<p><a href="{!! route('mbooks.create') !!}" class="btn btn-primary">Agregar</a></p>

<div id="items-list" style="padding-top: 5px;">

@forelse($mbooks as $mbook)
    @php
        $stateType = "primary";
        
        switch($mbook->state)
        {
            case "published": $stateType = "success"; break;
            case "private": $stateType = "secondary"; break;
            case "inactive": $stateType = "light"; break;
        }
    @endphp

    <div class="card" style="margin-bottom: 5px;">
        <div class="card-body">
            <h5 class="card-title">{{ $mbook->name }} / {{ $mbook->shortname }}</h5>
            <h6 class="card-subtitle mb-2 text-muted">
                {{ $mbook->category->name }}.&nbsp;&nbsp;
                <span class="badge badge-pill badge-{{ $stateType }}">{{ $mbook->state }}</span>
                <!-- {{ $mbook->updated_at->diffForHumans() }} -->
            </h6>
            <p class="card-text">
                
            </p>
            <a href="{{ route('mbooks.msections.index', $mbook->id) }}" class="btn btn-success btn-sm" style="margin-right: 5px; float:left">Contenidos</a>
            <a href="{{ route('mbooks.show', $mbook->id) }}" class="btn btn-info btn-sm" style="margin-right: 5px; float:left">Ver</a>
            <a href="{{ route('mbooks.edit', $mbook->id) }}" class="btn btn-warning btn-sm" style="margin-right: 5px; float:left">Editar</a>
            {!! Form::open([
                'method' => 'DELETE',
                'route' => ['mbooks.destroy', $mbook->id],
                'style' => 'float:left',
                'onsubmit' => 'return confirm("¿Está seguro de remover este elemento?")'
            ]) !!}
                {!! Form::submit('Remover', ['class' => 'btn btn-danger btn-sm']) !!}
            {!! Form::close() !!}
        </div>
    </div>

@empty

    <div class="alert alert-info" role="alert">
        No hay registros que mostrar.
    </div>

@endforelse

</div>

{{ $mbooks->links() }}

@stop