@extends('layouts.app')

@section('content')

<div class="container-fluid">

@include('layouts.subview_breadcrumbs') 

<h1>Secciones</h1>
<p class="lead">Listar las secciones de este libro.</p>
<p>
    <a href="{!! route('mbooks.msections.create', $mbook->id) !!}" class="btn btn-primary"><i class="fas fa-plus"></i> Agregar</a>
    <a href="{{ route('mbooks.index') }}" class="btn btn-info" style="margin-right: 5px; float:left"><i class="fas fa-arrow-left"></i> Volver</a>
</p>

<div class="row">
    <div id="sections_items-list" class="col-3" style="padding-top: 5px;">
        <p class="text-center h5">Secciones</p>

        @include('msections.subview_index_msections_list') 
    </div>

    <div class="col-9"></div>
</div>

<div class="row">
    <div class="col-4" style="">
        {{ $msections->links() }}
    </div>

    <div class="col-8"></div>
</div>

<br>

<p>
<a href="{{ route('mbooks.index') }}" class="btn btn-info" style="margin-right: 5px; float:left"><i class="fas fa-arrow-left"></i> Volver</a>
</p>

</div>

<br>

@stop