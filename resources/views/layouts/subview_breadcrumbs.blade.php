<!-- Breadcrumbs -->

@if(isset($mbook))

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li title="Libro" class="breadcrumb-item">
    &nbsp;
    </li>

    @if(isset($mbook))
    <li title="Libro" class="breadcrumb-item" @if(!isset($msection)) aria-current="page" @endif>
        @if(isset($msection))
        <a href="{{ route('mbooks.msections.index', $mbook->id) }}">{{ $mbook->name }}</a>
        @else
            {{ $mbook->name }}
        @endif
    </li>
    @endif 

    @if(isset($msection))
    <li title="Sección" class="breadcrumb-item" @if(!isset($msheet)) aria-current="page" @endif>
        @if(isset($msheet))
        <a href="{{ route('mbooks.msections.msheets.index', [$mbook->id, $msection->id]) }}">{{ $msection->name }}</a>
        @else
            {{ $msection->name }}
        @endif
    </li>
    @endif

    @if(isset($msheet))
    <li  title="Página" class="breadcrumb-item active" aria-current="page">
        {{ $msheet->name }}
    </li>
    @endif
  </ol>
</nav>

@endif

<!-- /Breadcrumbs -->