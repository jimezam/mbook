@extends('layouts.app')

@section('content')

<div class="container">
    <!-- Source selector -->
    <div class="row">
    @php
    $links[] = ['label' => 'Buscador', 
                'url' => route('bookbrowser.index', 'keywords'), 
                'source' => 'keywords'];
    $links[] = ['label' => 'Recientes', 
                'url' => route('bookbrowser.index', 'recents'), 
                'source' => 'recents'];
    $links[] = ['label' => 'Categorías', 
                'url' => route('bookbrowser.index', 'category'), 
                'source' => 'category'];
    @endphp
        <div class="col-12 mb-4">
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                @foreach($links as $item)
                @php $active = ($item['source'] == $source) ? 'active' : ''; @endphp
                <li class="nav-item">
                    <a class="nav-link {{ $active }}" id="pills-{{ $item['source'] }}-tab" 
                       href="{{ $item['url'] }}"aria-selected="{{ $active }}">{{ $item['label'] }}</a>
                </li>
                @endforeach
            </ul>
        </div>
    </div>

    <div class="row">
        <div class="col-2">
        </div>

        <div class="col-8">
            <p class="h1 text-center mb-5">
                ¿Qué quieres aprender hoy?
            </p>
            
            {!! Form::open([
                    'route' => 'bookbrowser.search',
                    'method' => 'GET'
            ]) !!}

            <div class="input-group pt-5 mb-5">
                <input type="text" class="form-control form-control-lg" id="data" name="data" placeholder="Palabras clave">
                <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fas fa-search"></i></div>
                </div>
            </div>

            {!! Form::close() !!}
        </div>

        <div class="col-2">
        </div>
    </div>
</div>

@stop