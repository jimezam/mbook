@push('scripts')

<script>

$(document).ready(function() {
    // First time on page load.
    setThemeStylesUpdate();

    // Handling the event onChange for selector.
    $('#theme').on('change', function() {
        setThemeStylesUpdate();
    });
});

function updateThemeStyles(data)
{
    $('#style').empty();

    $.each(data, function(key, value) {
        $('#style').append('<option value="'+ key +'">' + value + '</option>');
    });
}

function setThemeStylesUpdate()
{
    var theme = $("#theme option:selected").text();

    if(theme)
    {
        $.ajax({
            url: '/themes/' + theme + '/styles',
            type: "GET",
            dataType: "json",

            beforeSend: function() {
                $('#loading').modal('show');
            },

            success: function(data) {
                updateThemeStyles(data);
            },

            complete: function() { 
                $('#loading').modal('hide');
            }
        });
    } 
    else 
    {
        $('#style').empty();
    }
}

</script>

@endpush

<!-- --------------------------------- -->

<div class="form-group">
    {!! Form::label('category_id', 'Categoría', ['class' => 'control-label']) !!}
    {!! Form::select('category_id', $categories, null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('shortname', 'Nombre Corto', ['class' => 'control-label']) !!}
    {!! Form::text('shortname', null, ['class' => 'form-control', 'maxlength' => 13]) !!}
</div>

<div class="form-group">
    {!! Form::label('name', 'Nombre', ['class' => 'control-label']) !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'maxlength' => 100]) !!}
</div>

<div class="form-group">
    {!! Form::label('state', 'Estado', ['class' => 'control-label']) !!}
    {!! Form::select('state', $states, null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('description', 'Descripción', ['class' => 'control-label']) !!}
    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('theme', 'Tema', ['class' => 'control-label']) !!}
    {!! Form::select('theme', $themes, null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('style', 'Estilo', ['class' => 'control-label']) !!}
    {!! Form::select('style', $styles, null, ['class' => 'form-control']) !!}
</div>

<!-- --------------------------------- -->
