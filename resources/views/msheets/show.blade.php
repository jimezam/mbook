@extends('layouts.app')

@section('content')

<div class="container-fluid">

@include('layouts.subview_breadcrumbs') 

<h1>Página</h1>
<p class="lead">Ver información de una página específica.</p>
<p>
    <a href="{!! route('mbooks.msections.msheets.create', [$mbook, $msection]) !!}" class="btn btn-primary"><i class="fas fa-plus"></i> Agregar</a>
    <a href="{{ route('mbooks.msections.index', [$mbook, $msection]) }}" class="btn btn-info" style="margin-right: 5px; float:left"><i class="fas fa-arrow-left"></i> Volver</a>
</p>

<div class="row">
    <div id="sections_items-list" class="col-3" style="padding-top: 5px;">
        <p class="text-center h5">Secciones</p>

        @include('msections.subview_index_msections_list', 
                 ['msections' => $mbook->msections,
                  'msectionSelected' => $msection->id]) 
    </div>

    <div id="sheets_items-list" class="col-3" style="padding-top: 5px;">
        <p class="text-center h5">Páginas</p>

        @include('msheets.subview_index_msheets_list', 
                 ['msheetSelected' => $msheet->id]) 
    </div>

    <div class="col-6">
        <p class="text-center h5">Contenido</p>

        <div class="card">
            <div class="card-body">
                {!! nl2br($msheet->contents) !!}
            </div>
        </div>

        <div style="margin-top: 10px; margin-bottom: 50px;">
            <a href="{{ route('mbooks.msections.msheets.edit', [$mbook, $msection, $msheet]) }}" class="btn btn-warning btn-sm" style="margin-right: 5px; float:left"><i class="fas fa-pencil-alt"></i> Editar</a>
            {!! Form::open([
                'method' => 'DELETE',
                'route' => ['mbooks.msections.msheets.destroy', $mbook, $msection, $msheet],
                'style' => 'float:left',
                'onsubmit' => 'return confirm("¿Está seguro de remover este elemento?")'
            ]) !!}
                <button type="submit" class="btn btn-danger btn-sm" style="margin-right: 5px; float:left"><i class='fas fa-trash-alt'></i> Remover</button>
            {!! Form::close() !!}
        </div>

        <table class="table table-striped">
            <tr>
                <th scope="row">Color de letra</th>
                <td style="	font-family: Courier New,Courier,Lucida Sans Typewriter,Lucida Typewriter,monospace;">
                    {{ $msheet->foreground }}
                    <span style="background-color:{{ $msheet->foreground }}; border: 1px solid black;">&nbsp;&nbsp</span>
                </td>
            </tr>
            <tr>
                <th scope="row" style="width: 220px;">Color de fondo</th>
                <td style="	font-family: Courier New,Courier,Lucida Sans Typewriter,Lucida Typewriter,monospace;">
                    {{ $msheet->background }} 
                    <span style="background-color:{{ $msheet->background }}; border: 1px solid black;">&nbsp;&nbsp;</span>
                </td>
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