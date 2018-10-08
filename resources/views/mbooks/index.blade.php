@extends('layouts.app')

@section('content')

<div class="container">

<h1>Listar libros</h1>
<p class="lead">Listado de todos los libros escritos por ti.</p>
<p> <a href="{!! route('mbooks.create') !!}" class="btn btn-primary">Agregar</a></p>

<br>

<div class="table-responsive">
<table class="table table-hover table-striped">
    <thead class="thead-light">
        <tr>
            <th scope="col">Nombre</th>
            <th scope="col">Categoria</th>
            <th scope="col">Estado</th>
            <th scope="col">Opciones</th>
        </tr>
    </thead>
    <tbody class="">

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

<tr>
    <td>
        <p class="h5">{{ $mbook->name }}</p>
        <p>{{ $mbook->shortname }}</p>
    </td>

    <td>{{ $mbook->category->name }}</td>

    <td>
        <p><span class="badge badge-pill badge-{{ $stateType }}">{{ $mbook->state }}</span> <br>
        {{ $mbook->updated_at->diffForHumans() }}</p>
    </td>

    <td>
        <div class="btn-group" role="group" aria-label="Opciones">
            <a href="{{ route('mbooks.show', $mbook->id) }}" class="btn btn-info">Ver</a>
            <a href="{{ route('mbooks.edit', $mbook->id) }}" class="btn btn-warning">Edit User</a>
            {!! Form::open([
                'method' => 'DELETE',
                'route' => ['mbooks.destroy', $mbook->id]
            ]) !!}
                {!! Form::submit('Remover', ['class' => 'btn btn-danger']) !!}
            {!! Form::close() !!}
        </div>
    </td>
</tr>

@empty

<div class="alert alert-info" role="alert">
  No hay registros que mostrar.
</div>

@endforelse

    </tbody>
</table>
</div>

{{ $mbooks->links() }}

</div>

@stop