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

  @include('layouts.subview_breadcrumbs') 

  <br>

  <h1>Ver Libro</h1>
  <p class="lead">Consultar la información completa de este libro.</p>

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

  <div>
    <a href="{{ route('mbooks.index') }}" class="btn btn-info" style="margin-right: 5px; float:left"><i class="fas fa-arrow-left"></i> Volver</a>
    <a href="{{ route('mbooks.msections.index', $mbook->id) }}" class="btn btn-success" style="margin-right: 5px; float:left"><i class="fas fa-file-alt"></i> Secciones</a>
    <a href="{{ route('mbooks.edit', $mbook->id) }}" class="btn btn-warning" style="margin-right: 5px; float:left"><i class="fas fa-pencil-alt"></i> Editar</a>
    {!! Form::open([
        'method' => 'DELETE',
        'route' => ['mbooks.destroy', $mbook->id],
        'style' => 'float:left',
        'onsubmit' => 'return confirm("¿Está seguro de remover este elemento?")'
    ]) !!}
        <button type="submit" class="btn btn-danger"><i class='fas fa-trash-alt'></i> Remover</button>
    {!! Form::close() !!}
  </div>

</div>

<br><br>

@stop