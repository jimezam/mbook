@extends('layouts.app')

@section('content')

<div class="container">

@include('layouts.subview_breadcrumbs') 

<h1>Listar Páginas</h1>
<p class="lead">
    Listar las páginas de esta sección.
</p>
<p>
    <a href="{!! route('mbooks.msections.msheets.create', [$mbook, $msection]) !!}" class="btn btn-primary">Agregar</a>
    <a href="{{ route('mbooks.msections.index', [$mbook, $msection]) }}" class="btn btn-info" style="margin-right: 5px; float:left">Volver</a>
</p>

<div id="items-list" style="padding-top: 5px;">

@forelse($msheets as $msheet)

    <div class="card" style="margin-bottom: 5px;">
        <div class="card-body">
            <h5 class="card-title">{{ $msheet->name }}</h5>
            <h6 class="card-subtitle mb-2 text-muted"></h6>
            <p class="card-text">
                
            </p>
            <a href="{{ route('mbooks.msections.msheets.show', [$mbook, $msection, $msheet]) }}" class="btn btn-info btn-sm" style="margin-right: 5px; float:left">Ver</a>
            <a href="{{ route('mbooks.msections.msheets.edit', [$mbook, $msection, $msheet]) }}" class="btn btn-warning btn-sm" style="margin-right: 5px; float:left">Editar</a>
            {!! Form::open([
                'method' => 'DELETE',
                'route' => ['mbooks.msections.msheets.destroy', $mbook, $msection, $msheet],
                'style' => 'float:left',
                'onsubmit' => 'return confirm("¿Está seguro de remover este elemento?")'
            ]) !!}
                {!! Form::submit('Remover', ['class' => 'btn btn-danger btn-sm', 'style' => "margin-right: 5px; float:left"]) !!}
            {!! Form::close() !!}
            <a href="{{ route('mbooks.msections.msheets.moveDown', [$mbook, $msection, $msheet]) }}" class="btn btn-secondary btn-sm" style="margin-right: 5px; float:left">Subir</a>
            <a href="{{ route('mbooks.msections.msheets.moveUp', [$mbook, $msection, $msheet]) }}" class="btn btn-secondary btn-sm" style="margin-right: 5px; float:left">Bajar</a>
        </div>
    </div>

@empty

    <div class="alert alert-info" role="alert">
        No hay registros que mostrar.
    </div>

@endforelse

</div>

{{ $msheets->links() }}

<br>

<p>
    <a href="{{ route('mbooks.msections.index', [$mbook, $msection]) }}" class="btn btn-info" style="margin-right: 5px; float:left">Volver</a>
</p>

</div>

@stop