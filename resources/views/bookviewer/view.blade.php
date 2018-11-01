@extends('layouts.book')

@section('content')

<div class="container">

    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-body">
                    <p class="h3">{{ $mbook->name }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div id="sections" class="col-4 mbook_toc">
        @forelse($mbook->msections as $_msection)
            <div class="card mb-2">
                <div class="card-header" id="section-heading-{{ $_msection->id }}">
                    <h5 class="mb-0">
                        <button class="btn btn-link" data-toggle="collapse" data-target="#section-collapse-{{ $_msection->id }}" aria-expanded="true" aria-controls="section-collapse-{{ $_msection->id }}">
                        {{ $_msection->name }} <i class="fas fa-caret-down"></i>
                        </button>
                    </h5>
                </div>
                <div id="section-collapse-{{ $_msection->id }}" class="collapse @if($_msection->id==$msection->id) show @endif" aria-labelledby="section-heading-{{ $_msection->id }}" data-parent="#sections">
                    <div class="card-body-x">
                        <ul class="list-group">
                        @forelse($_msection->msheets as $_msheet)
                            <li class="list-group-item @if($_msheet->id==$msheet->id) bg-info @endif">
                                <a href="{{ route('bookviewer.view', [$code, $_msection, $_msheet]) }}" 
                                   class="@if($_msheet->id==$msheet->id) text-white @endif">
                                    {{ $_msheet->name }}
                                </a>
                            </li>
                        @empty
                            <div class="alert alert-info" role="alert">
                                No hay secciones que mostrar.
                            </div>
                        @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        @empty
            <div class="alert alert-info" role="alert">
                No hay secciones que mostrar.
            </div>
        @endforelse
        </div>
    
        <div class="col-8">
        @if($msheet != null)
            @php
            if($msheet->background == null)
                $msheet->background = "#ffffff";
            if($msheet->foreground == null)
                $msheet->foreground = "#000000";
            @endphp

            <div class="card">
                <div id="mbook_sheet" class="card-body" style="background-color: {{ $msheet->background }}; color: {{ $msheet->foreground }}">
                    {!! nl2br($msheet->contents) !!}
                </div>
            </div>
        @else
            <div class="alert alert-info" role="alert">
                No hay una página que mostrar.
            </div>
        @endif
        </div>
    </div>

</div>

<br>

@stop