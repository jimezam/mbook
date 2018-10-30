@forelse($msheets as $msheet)

<div class="card mb-2 pb-0 @if(isset($msheetSelected) && $msheetSelected == $msheet->id) alert-primary @endif" onclick="$('#sheet_element-{{ $msheet->id }}')[0].click()">
    <div class="card-body mb-0" id="sheet_heading-{{ $msheet->id }}">
        <a id="sheet_element-{{ $msheet->id }}" data-toggle="collapse" role="button" aria-expanded="true" 
        href="#sheet_collapse-{{ $msheet->id }}" aria-controls="sheet_collapse-{{ $msheet->id }}" style="color: black">               
            <h5 class="card-title">{{ $msheet->name }}</h5>
        </a>
        <a href="{{ route('mbooks.msections.msheets.moveDown', [$mbook, $msection, $msheet]) }}" onclick="event.stopPropagation()"  class="btn btn-secondary btn-sm" style="margin-right: 5px; float:left"><i class="fas fa-long-arrow-alt-up"></i> Subir</a>
        <a href="{{ route('mbooks.msections.msheets.moveUp', [$mbook, $msection, $msheet]) }}" onclick="event.stopPropagation()"  class="btn btn-secondary btn-sm" style="margin-right: 5px; float:left"><i class="fas fa-long-arrow-alt-down"></i> Bajar</a>
    </div>

    <div id="sheet_collapse-{{ $msheet->id }}" class="collapse pb-3" 
        aria-labelledby="sheet_heading-{{ $msheet->id }}" data-parent="#sheets_items-list">
        <div class="card-body mt-0 pt-0">
            <hr>
            <!-- <p class="card-text"></p> -->

            <a href="{{ route('mbooks.msections.msheets.show', [$mbook, $msection, $msheet]) }}" onclick="event.stopPropagation()" class="btn btn-info btn-sm" style="margin-right: 5px; float:left"><i class="fas fa-eye"></i> Ver</a>
            <a href="{{ route('mbooks.msections.msheets.edit', [$mbook, $msection, $msheet]) }}" onclick="event.stopPropagation()" class="btn btn-warning btn-sm" style="margin-right: 5px; float:left"><i class="fas fa-pencil-alt"></i> Editar</a>
            {!! Form::open([
                'method' => 'DELETE',
                'route' => ['mbooks.msections.msheets.destroy', $mbook, $msection, $msheet],
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