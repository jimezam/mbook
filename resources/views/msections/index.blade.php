@extends('layouts.app')

@section('content')

<div class="container">

@include('layouts.subview_breadcrumbs') 

<br>

<h1>Listar Secciones</h1>
<p class="lead">Listar las secciones de este libro.</p>
<p>
    <a href="{!! route('mbooks.msections.create', $mbook->id) !!}" class="btn btn-primary"><i class="fas fa-plus"></i> Agregar</a>
    <a href="{{ route('mbooks.index') }}" class="btn btn-info" style="margin-right: 5px; float:left"><i class="fas fa-arrow-left"></i> Volver</a>
</p>

<div id="items-list" style="padding-top: 5px;">

@forelse($msections as $msection)

    <div class="card" style="margin-bottom: 5px;">
        <div class="card-body">
            <h5 class="card-title">{{ $msection->name }}</h5>
            <h6 class="card-subtitle mb-2 text-muted"></h6>
            <p class="card-text">
                
            </p>
            <a href="{{ route('mbooks.msections.msheets.index', [$mbook, $msection]) }}" class="btn btn-success btn-sm" style="margin-right: 5px; float:left"><i class="fas fa-file"></i> Páginas</a>
            <a href="{{ route('mbooks.msections.show', [$mbook, $msection]) }}" class="btn btn-info btn-sm" style="margin-right: 5px; float:left"><i class="fas fa-eye"></i> Ver</a>
            <a href="{{ route('mbooks.msections.edit', [$mbook, $msection]) }}" class="btn btn-warning btn-sm" style="margin-right: 5px; float:left"><i class="fas fa-pencil-alt"></i> Editar</a>
            {!! Form::open([
                'method' => 'DELETE',
                'route' => ['mbooks.msections.destroy', $mbook, $msection],
                'style' => 'float:left',
                'onsubmit' => 'return confirm("¿Está seguro de remover este elemento?")'
            ]) !!}
                <button type="submit" class="btn btn-danger btn-sm" style="margin-right: 5px; float:left"><i class='fas fa-trash-alt'></i> Remover</button>
            {!! Form::close() !!}
            <a href="{{ route('mbooks.msections.moveDown', [$mbook, $msection]) }}" class="btn btn-secondary btn-sm" style="margin-right: 5px; float:left"><i class="fas fa-long-arrow-alt-up"></i> Subir</a>
            <a href="{{ route('mbooks.msections.moveUp', [$mbook, $msection]) }}" class="btn btn-secondary btn-sm" style="margin-right: 5px; float:left"><i class="fas fa-long-arrow-alt-down"></i> Bajar</a>
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
<a href="{{ route('mbooks.index') }}" class="btn btn-info" style="margin-right: 5px; float:left"><i class="fas fa-arrow-left"></i> Volver</a>
</p>

</div>

<br>

@stop