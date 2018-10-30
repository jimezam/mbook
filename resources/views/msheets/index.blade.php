@extends('layouts.app')

@section('content')

<div class="container">

@include('layouts.subview_breadcrumbs') 

<h1>Páginas</h1>
<p class="lead">Listar las páginas de esta sección.</p>
<p>
    <a href="{!! route('mbooks.msections.msheets.create', [$mbook, $msection]) !!}" class="btn btn-primary"><i class="fas fa-plus"></i> Agregar</a>
    <a href="{{ route('mbooks.msections.index', [$mbook, $msection]) }}" class="btn btn-info" style="margin-right: 5px; float:left"><i class="fas fa-arrow-left"></i> Volver</a>
</p>

<div class="row">
    <div id="sections_items-list" class="col-4" style="padding-top: 5px;">
        @include('msections.subview_index_msections_list', 
                 ['msections' => $mbook->msections,
                  'msectionSelected' => $msection->id]) 
    </div>

    <div id="sheets_items-list" class="col-4" style="padding-top: 5px;">
        @include('msheets.subview_index_msheets_list') 
    </div>

    <div class="col-4"></div>
</div>

<div class="row">
    <div class="col-4" style=""></div>

    <div class="col-4" style="">
        {{ $msheets->links() }}
    </div>

    <div class="col-4"></div>
</div>

<br>

<p>
    <a href="{{ route('mbooks.msections.index', [$mbook, $msection]) }}" class="btn btn-info" style="margin-right: 5px; float:left"><i class="fas fa-arrow-left"></i> Volver</a>
</p>

</div>

<br>

@stop