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

        <div class="col-3">
        <p class="h4 text-center">Categorías</p>

            <ul class="list-group list-group-flush mt-3">
            @forelse($categories as $category)
                <li class="list-group-item d-flex justify-content-between align-items-center @if(($source=='recents' | $source=='category') & $category->id==$data) bg-info @endif">
                    <a href="{{ route('bookbrowser.index', ['recents', 'data'=>$category->id]) }}" class="@if(($source=='recents' | $source=='category') & $category->id==$data) text-white @endif">{{ $category->name }}</a>
                    <span class="badge badge-primary">{{ $category->mbooks()->updated()->published()->count() }}</span>
                </li>
            @empty
                <div class="alert alert-info" role="alert">
                    No hay categorías que mostrar.
                </div>
            @endforelse
            </ul>
        </div>

        <div class="col-9">

            <p class="h4 text-center">
                Libros recientes
            </p>

            <br> 

            @forelse($books as $book)
                @include('bookbrowser.subview_book_entry')
            @empty
                <div class="alert alert-info" role="alert">
                    No hay libros que mostrar.
                </div>
            @endforelse

            {{ $books->links() }}
        </div>

    </div>
</div>

@stop