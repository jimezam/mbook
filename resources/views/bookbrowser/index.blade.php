@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">

        <div class="col-3">
        <p class="h4 text-center">Categorías</p>

            <ul class="list-group list-group-flush">
            @forelse($categories as $category)
                <li class="list-group-item d-flex justify-content-between align-items-center @if($source=='category' & $category->id==$data) bg-info @endif">
                    <a href="{{ route('bookbrowser.index', ['category', 'data'=>$category->id]) }}" class="@if($source=='category' & $category->id==$data) text-white @endif">{{ $category->name }}</a>
                    <span class="badge badge-primary">{{ $category->mbooks()->count() }}</span>
                </li>
            @empty
                <div class="alert alert-info" role="alert">
                    No hay categorías que mostrar.
                </div>
            @endforelse
            </ul>
        </div>

        <div class="col-9">
            <div class="input-group mt-2 mb-5">
                <input type="text" class="form-control form-control-lg" id="keywords" placeholder="Palabras clave">
                <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fas fa-search"></i></div>
                </div>
            </div>

            <p class="h4 text-center">
            @switch($source)
                @case("recents")
                    Libros recientes
                @break

                @case("category")
                    Libros por categoría: <strong>{{ $object->name }}</strong>
                @break

                @case("keywords")
                    Búsqueda de palabras clave: <strong>{{ $data }}</strong>
                @break

                @default
                    !Opción desconocida!
            @endswitch
            </p>

            <br> 

            @forelse($books as $book)
                @include('bookbrowser.subview_book_entry');
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