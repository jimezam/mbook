@forelse($msections as $msection)

<div class="card mb-2 pb-0 @if(isset($msectionSelected) && $msectionSelected == $msection->id) alert-primary @endif" onclick="$('#section_element-{{ $msection->id }}')[0].click()">
    <div class="card-body mb-0" id="section_heading-{{ $msection->id }}">
        <a id="section_element-{{ $msection->id }}" data-toggle="collapse" role="button" aria-expanded="true" 
        href="#section_collapse-{{ $msection->id }}" aria-controls="section_collapse-{{ $msection->id }}" style="color: black">               
            <h5 class="card-title">{{ $msection->name }}</h5>
        </a>
        <a href="{{ route('mbooks.msections.moveDown', [$mbook, $msection]) }}" onclick="event.stopPropagation()" class="btn btn-secondary btn-sm" style="margin-right: 5px; float:left"><i class="fas fa-long-arrow-alt-up"></i> Subir</a>
        <a href="{{ route('mbooks.msections.moveUp', [$mbook, $msection]) }}"  onclick="event.stopPropagation()" class="btn btn-secondary btn-sm" style="margin-right: 5px; float:left"><i class="fas fa-long-arrow-alt-down"></i> Bajar</a>
    </div>

    <div id="section_collapse-{{ $msection->id }}" class="collapse pb-3" 
        aria-labelledby="section_heading-{{ $msection->id }}" data-parent="#sections_items-list">
        <div class="card-body mt-0 pt-0">
            <hr>
            <!-- <p class="card-text"></p> -->
            <a href="{{ route('mbooks.msections.msheets.index', [$mbook, $msection]) }}" onclick="event.stopPropagation()"  class="btn btn-success btn-sm" style="margin-right: 5px; float:left"><i class="fas fa-file"></i> Páginas</a>
            <a href="{{ route('mbooks.msections.show', [$mbook, $msection]) }}" onclick="event.stopPropagation()" class="btn btn-info btn-sm" style="margin-right: 5px; float:left"><i class="fas fa-eye"></i> Ver</a>
            <a href="{{ route('mbooks.msections.edit', [$mbook, $msection]) }}" onclick="event.stopPropagation()" class="btn btn-warning btn-sm" style="margin-right: 5px; float:left"><i class="fas fa-pencil-alt"></i> Editar</a>
            {!! Form::open([
                'method' => 'DELETE',
                'route' => ['mbooks.msections.destroy', $mbook, $msection],
                'style' => 'float:left',
                'onsubmit' => 'return confirm("¿Está seguro de remover este elemento?")'
            ]) !!}
                <button type="submit" onclick="event.stopPropagation()" class="btn btn-danger btn-sm" style="margin-right: 5px; float:left"><i class='fas fa-trash-alt'></i> Remover</button>
            {!! Form::close() !!}
        </div>
    </div>
</div>

@empty

<div class="alert alert-info" role="alert">
    No hay registros que mostrar.
</div>

@endforelse