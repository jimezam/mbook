@extends('layouts.app')

@section('content')

@php
    $stateType = "primary";
    
    switch($mbook->state)
    {
        case "published": $stateType = "success"; break;
        case "private": $stateType = "secondary"; break;
        case "inactive": $stateType = "light"; break;
    }
@endphp
    
<div class="container">

<h1>{{ $mbook->name }}</h1>
<p class="lead">Información completa de este libro.</p>

<br>

<table class="table table-striped">
<tr>
  <th scope="row" style="width: 200px;">Id</th>
  <td>{{ $mbook->id }}</td>
</tr>
<tr>
  <th scope="row">Nombre Corto</th>
  <td>{{ $mbook->shortname }}</td>
</tr>
<tr>
  <th scope="row">Propietario</th>
  <td>{{ $mbook->user->name }} &lt;{{ $mbook->user->email }}&gt;</td>
</tr>
<tr>
  <th scope="row">Categoria</th>
  <td>{{ $mbook->category->name }}</td>
</tr>
<tr>
  <th scope="row">Estado</th>
  <td><span class="badge badge-pill badge-{{ $stateType }}">{{ $mbook->state }}</span></td>
</tr>
<tr>
  <th scope="row">Descripción</th>
  <td>{!! nl2br($mbook->description) !!}</td>
</tr>
<tr>
  <th scope="row">Fecha de Creación</th>
  <td>{{ $mbook->created_at->format('d/m/Y H:i') }}</td>
</tr>
<tr>
  <th scope="row">Fecha de Actualización</th>
  <td>{{ $mbook->updated_at->format('d/m/Y H:i') }}</td>
</tr>
</table>

<br>

<a href="{{ route('mbooks.index') }}" class="btn btn-info" style="margin-right: 5px; float:left">Volver</a>
<a href="{{ route('mbooks.msections.index', $mbook->id) }}" class="btn btn-success" style="margin-right: 5px; float:left">Secciones</a>
<a href="{{ route('mbooks.edit', $mbook->id) }}" class="btn btn-warning" style="margin-right: 5px; float:left">Editar</a>
{!! Form::open([
    'method' => 'DELETE',
    'route' => ['mbooks.destroy', $mbook->id],
    'style' => 'float:left',
    'onsubmit' => 'return confirm("¿Está seguro de remover este elemento?")'
]) !!}
    {!! Form::submit('Remover', ['class' => 'btn btn-danger']) !!}
{!! Form::close() !!}

</div>

@stop