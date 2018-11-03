@php 
    $badge = null;
    $badgeType = "";

    if($book->isUpdated())
    {
        $badge = "Updated";
        $badgeType = "info";
    }

    if($book->isNew())
    {
        $badge = "New";
        $badgeType = "warning";
    }
@endphp

<div class="card mb-3">
    <div class="card-body">
        <h3 class="card-title">
            <a href="{{ route('bookviewer.index', $book->shortname) }}" style="color: black">{{ $book->name }}</a>
            @if($badge != null) 
                &nbsp;<span class="badge badge-{{ $badgeType }}">{{ __($badge) }}</span>
            @endif   
        </h3>
        <h5 class="card-subtitle mb-2">
            {{ $book->user->name }} <!-- <{{ Html::mailto($book->user->email) }}> --> <br>
            {{ $book->category->name }}
        </h5>
        <p class="card-text text-muted">
            {{ $book->updated_at->format('M j, Y') }}
        </p>
        <a href="{{ route('bookviewer.index', $book->shortname) }}" class="card-link">Leer</a>
        <a href="{{ route('bookviewer.metadata', $book->shortname) }}" class="card-link">Metadatos</a>
        @if($book->user_id == Auth::id())
        <a href="{{ route('mbooks.edit', $book->id) }}" class="card-link">Editar Libro</a>
        <a href="{{ route('mbooks.msections.index', $book->id) }}" class="card-link">Editar Contenidos</a>
        @endif
    </div>
</div>
