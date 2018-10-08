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
  <td style="width: 200px;">Id</td>
  <td>{{ $mbook->id }}</td>
</tr>
<tr>
  <td>Nombre Corto</td>
  <td>{{ $mbook->shortname }}</td>
</tr>
<tr>
  <td>Propietario</td>
  <td>{{ $mbook->user->name }} &lt;{{ $mbook->user->email }}&gt;</td>
</tr>
<tr>
  <td>Categoria</td>
  <td>{{ $mbook->category->name }}</td>
</tr>
<tr>
  <td>Estado</td>
  <td><span class="badge badge-pill badge-{{ $stateType }}">{{ $mbook->state }}</span></td>
</tr>
<tr>
  <td>Descripción</td>
  <td>{{ $mbook->description }}</td>
</tr>
<tr>
  <td>Fecha de Creación</td>
  <td>{{ $mbook->created_at->format('d/m/Y H:i') }}</td>
</tr>
<tr>
  <td>Fecha de Actualización</td>
  <td>{{ $mbook->updated_at->format('d/m/Y H:i') }}</td>
</tr>
</table>

<br>

<a href="{{ route('mbooks.index') }}" class="btn btn-info" style="margin-right: 5px; float:left">Volver</a>
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