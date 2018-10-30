@extends('layouts.app')

@section('content')

<div class="container">

@include('layouts.subview_breadcrumbs') 

<h1>Libros</h1>
<p class="lead">Listar todos los libros escritos por ti.</p>
<p><a href="{!! route('mbooks.create') !!}" class="btn btn-primary"><i class="fas fa-plus"></i> Agregar</a></p>

<div id="items-list" style="padding-top: 5px;">

@forelse($mbooks as $mbook)
    @php
        $stateType = "primary";
        
        switch($mbook->state)
        {
            case "published": $stateType = "primary";   break;
            case "private":   $stateType = "secondary"; break;
            case "inactive":  $stateType = "light";     break;
        }
    @endphp

    <div class="card mb-2 pb-0" onclick="$('#element-{{ $mbook->id }}')[0].click()">
        <div class="card-body mb-0" id="heading-{{ $mbook->id }}">
            <a id="element-{{ $mbook->id }}" data-toggle="collapse" role="button" aria-expanded="true" 
               href="#collapse-{{ $mbook->id }}" aria-controls="collapse-{{ $mbook->id }}" style="color: black">
                <h3 class="card-title">{{ $mbook->name }} ({{ $mbook->shortname }})</h3>
            </a>
            <div class="card-subtitle mb-2 text-muted h5">
                {{ $mbook->category->name }}.&nbsp;&nbsp;
                <span class="badge badge-pill badge-{{ $stateType }}">{{ $mbook->state }}</span>
                <!-- {{ $mbook->updated_at->diffForHumans() }} -->
            </div>
        </div>

        <div id="collapse-{{ $mbook->id }}" class="collapse pb-3" 
            aria-labelledby="heading-{{ $mbook->id }}" data-parent="#items-list">
            <div class="card-body mt-0 pt-0">
                <hr>
                <!-- <p class="card-text"></p> -->
                <a href="{{ route('mbooks.msections.index', $mbook->id) }}" onclick="event.stopPropagation()" class="btn btn-success btn-sm" style="margin-right: 5px; float:left"><i class="fas fa-file-alt"></i> Secciones</a>
                <a href="{{ route('mbooks.show', $mbook->id) }}" onclick="event.stopPropagation()" class="btn btn-info btn-sm" style="margin-right: 5px; float:left"><i class="fas fa-eye"></i> Ver</a>
                <a href="{{ route('mbooks.edit', $mbook->id) }}" onclick="event.stopPropagation()" class="btn btn-warning btn-sm" style="margin-right: 5px; float:left"><i class="fas fa-pencil-alt"></i> Editar</a>
                {!! Form::open([
                    'method' => 'DELETE',
                    'route' => ['mbooks.destroy', $mbook->id],
                    'style' => 'float:left',
                    'onsubmit' => 'return confirm("¿Está seguro de remover este elemento?")'
                ]) !!}
                    <button type="submit" onclick="event.stopPropagation()" class="btn btn-danger btn-sm"><i class='fas fa-trash-alt'></i> Remover</button>
                {!! Form::close() !!}
            </div>
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