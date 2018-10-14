@extends('layouts.app')

@section('content')

<div class="container">

<h1>Ver página</h1>
<p class="lead">
    Información completa de la página <span class="h4">"{{ $msheet->name }}"</span>
    de la sección <span class="h4">"{{ $msection->name }}"</span> 
    del libro <span class="h4">"{{ $mbook->name }}"</span>.
</p>
<p>
    <a href="{!! route('mbooks.msections.msheets.create', [$mbook, $msection]) !!}" class="btn btn-primary">Agregar</a>
    <a href="{{ route('mbooks.msections.index', [$mbook, $msection]) }}" class="btn btn-info" style="margin-right: 5px; float:left">Volver</a>
</p>

<div class="row">
    <div id="items-list" class="col-md-5" style="padding-top: 5px;">

    @forelse($msheets as $_msheet)

        <div class="card" style="margin-bottom: 5px;">
            <div class="card-body {{ ($msheet->id == $_msheet->id) ? 'aler alert-primary' : '' }}">
                <h5 class="card-title">{{ $_msheet->name }}</h5>
                <h6 class="card-subtitle mb-2 text-muted"></h6>
                <p class="card-text">
                    
                </p>
                <a href="{{ route('mbooks.msections.msheets.show', [$mbook, $msection, $_msheet]) }}" class="btn btn-info btn-sm" style="margin-right: 5px; float:left">Ver</a>
                <a href="{{ route('mbooks.msections.msheets.edit', [$mbook, $msection, $_msheet]) }}" class="btn btn-warning btn-sm" style="margin-right: 5px; float:left">Editar</a>
                {!! Form::open([
                    'method' => 'DELETE',
                    'route' => ['mbooks.msections.msheets.destroy', $mbook, $msection, $_msheet],
                    'style' => 'float:left',
                    'onsubmit' => 'return confirm("¿Está seguro de remover este elemento?")'
                ]) !!}
                    {!! Form::submit('Remover', ['class' => 'btn btn-danger btn-sm', 'style' => "margin-right: 5px; float:left"]) !!}
                {!! Form::close() !!}
                <a href="{{ route('mbooks.msections.msheets.moveDown', [$mbook, $msection, $_msheet]) }}" class="btn btn-secondary btn-sm" style="margin-right: 5px; float:left">Subir</a>
                <a href="{{ route('mbooks.msections.msheets.moveUp', [$mbook, $msection, $_msheet]) }}" class="btn btn-secondary btn-sm" style="margin-right: 5px; float:left">Bajar</a>
            </div>
        </div>

    @empty

        <div class="alert alert-info" role="alert">
            No hay registros que mostrar.
        </div>

    @endforelse

    </div>
    <div id="items-show" class="col-md-7">
        <div class="card">
            <div class="card-body">
                {!! nl2br($msheet->contents) !!}
            </div>
        </div>

        <br>

        <table class="table table-striped">
            <tr>
                <th scope="row" style="width: 220px;">Background</th>
                <td>{{ $msheet->background }}</td>
            </tr>
            <tr>
                <th scope="row">Foreground</th>
                <td>{{ $msheet->foreground }}</td>
            </tr>
            <tr>
                <th scope="row">Fecha de Creación</th>
                <td>{{ $msheet->created_at->format('d/m/Y H:i') }}</td>
            </tr>
            <tr>
                <th scope="row">Fecha de Actualización</th>
                <td>{{ $msheet->updated_at->format('d/m/Y H:i') }}</td>
            </tr>
        </table>
    </div>
</div>

{{ $msheets->links() }}

<br>

<p>
    <a href="{{ route('mbooks.msections.index', [$mbook, $msection]) }}" class="btn btn-info" style="margin-right: 5px; float:left">Volver</a>
</p>

</div>

@stop