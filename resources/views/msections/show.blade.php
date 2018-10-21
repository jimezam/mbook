@extends('layouts.app')

@section('content')

<div class="container">

@include('layouts.subview_breadcrumbs') 

<br>

<h1>Ver Sección</h1>
<p class="lead">Consultar la información completa de esta sección.</p>

<br>

<table class="table table-striped">
<tr>
  <th scope="row" style="width: 200px;">Libro</th>
  <td>{{ $mbook->name }}</td>
</tr>
<tr>
  <th scope="row">Id</th>
  <td>{{ $msection->id }}</td>
</tr>
<tr>
  <th scope="row">Descripción</th>
  <td>{!! nl2br($msection->description) !!}</td>
</tr>
<tr>
  <th scope="row">Orden</th>
  <td>{{ $msection->order }}</td>
</tr>
<tr>
  <th scope="row">Fecha de Creación</th>
  <td>{{ $msection->created_at->format('d/m/Y H:i') }}</td>
</tr>
<tr>
  <th scope="row">Fecha de Actualización</th>
  <td>{{ $msection->updated_at->format('d/m/Y H:i') }}</td>
</tr>
</table>

<br>

<a href="{{ route('mbooks.msections.index', $mbook) }}" class="btn btn-info" style="margin-right: 5px; float:left">Volver</a>
<a href="{{ route('mbooks.msections.msheets.index', [$mbook, $msection]) }}" class="btn btn-success" style="margin-right: 5px; float:left">Páginas</a>
<a href="{{ route('mbooks.msections.edit', [$mbook, $msection]) }}" class="btn btn-warning" style="margin-right: 5px; float:left">Editar</a>
{!! Form::open([
    'method' => 'DELETE',
    'route' => ['mbooks.msections.destroy', $mbook, $msection],
    'style' => 'float:left',
    'onsubmit' => 'return confirm("¿Está seguro de remover este elemento?")'
]) !!}
    {!! Form::submit('Remover', ['class' => 'btn btn-danger']) !!}
{!! Form::close() !!}

</div>

@stop