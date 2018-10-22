@extends('layouts.app')

@section('content')

<div class="container">
    <h1>Tablero</h1>

    <div class="row justify-content-left mt-4">
        <!-- Reading -->

        <div class="col-md-4">
            <h2 class="mb-4">Estoy leyendo</h2>

            <div class="alert alert-info" role="alert">
                No hay libros que mostrar.
            </div>
        </div>
        
        <!-- Writing -->

        <div class="col-md-4">
            <h2 class="mb-4">Estoy escribiendo</h2>

            @forelse($mbooksMine as $mbook)

            @php
                $stateType = "primary";

                switch($mbook->state)
                {
                    case "published": $stateType = "primary";   break;
                    case "private":   $stateType = "secondary"; break;
                    case "inactive":  $stateType = "light";     break;
                }
            @endphp

            <div class="card mb-2">
                <div class="card-body">
                    <a href="{{ route('mbooks.msections.index', [$mbook]) }}" alt="" style="color: black">
                        <h4 class="card-title">{{ $mbook->name }}</h4>
                    </a>
                    <div class="card-subtitle mb-2 text-muted h5">
                        {{ $mbook->category->name }}.<br>
                        {{ $mbook->updated_at->diffForHumans() }}. &nbsp;&nbsp;<br>
                        <span class="badge badge-pill badge-{{ $stateType }}">{{ $mbook->state }}</span> <br>
                    </div>
                </div>
            </div>

            @empty

            <div class="alert alert-info" role="alert">
                No hay libros que mostrar.
            </div>

            @endforelse

            {{ $mbooksMine->links() }}
        </div>

        <!-- Recent updates -->

        <div class="col-md-4">
            <h2 class="mb-4">Actualizaciones recientes</h2>

            @forelse($mbooksRecent as $mbook)

            @php 
                $badge = null;
                $badgeType = "";

                if($mbook->isUpdated())
                {
                    $badge = "Updated";
                    $badgeType = "info";
                }

                if($mbook->isNew())
                {
                    $badge = "New";
                    $badgeType = "warning";
                }
            @endphp

            <div class="card mb-2">
                <div class="card-body">
                    <h4 class="card-title">
                        {{ $mbook->name }}&nbsp;
                        @if($badge != null) 
                            <span class="badge badge-{{ $badgeType }}">{{ $badge }}</span>
                        @endif    
                    </h4>
                    <div class="card-subtitle mb-2 text-muted h5">
                        {{ $mbook->category->name }}.<br>
                        {{ $mbook->user->name }}.<br>
                        {{ $mbook->updated_at->diffForHumans() }}.
                        @php $mbook->isNew() @endphp
                    </div>
                </div>
            </div>

            @empty

            <div class="alert alert-info" role="alert">
                No hay libros que mostrar.
            </div>

            @endforelse

            {{ $mbooksRecent->links() }}
        </div>
    </div>
</div>

@endsection
