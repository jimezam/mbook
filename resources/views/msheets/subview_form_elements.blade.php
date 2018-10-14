@php

$foreground = "#000000";
$background = "#ffffff";

if(isset($msheet))
{
    $foreground = $msheet->foreground;
    $background = $msheet->background;
}

@endphp

<!-- --------------------------------- -->

<div class="form-group">
    {!! Form::label('name', 'Nombre', ['class' => 'control-label']) !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'maxlength' => 100]) !!}
</div>

<div class="form-group">
    {!! Form::label('contents', 'Contenido', ['class' => 'control-label']) !!}
    {!! Form::textarea('contents', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('customize', '¿Personalizar colores?', ['class' => 'control-label']) !!}
    {!! Form::select('customize', ['n' => 'No', 'y' => 'Si'], null, ['class' => 'form-control']); !!}
</div>

<div class="form-group">
    {!! Form::label('foreground', 'Color de letra', ['class' => 'control-label']) !!}
    <input type="color" id="foreground" name="foreground" value="{{ old('foreground', $foreground) }}" class="form-control">
</div>

<div class="form-group">
    {!! Form::label('background', 'Background', ['class' => 'control-label']) !!}
    <input type="color" id="background" name="background" value="{{ old('background', $background) }}" class="form-control">
</div>

<!-- --------------------------------- -->

<script>
jQuery(document).ready(function() {
    manageColorsCustomizeState($('#customize').val());

    $('#customize').change(function() {
        manageColorsCustomizeState(this.value);
    });
});

function manageColorsCustomizeState(state)
{
    if(state == 'y')
    {
        $("#foreground").removeAttr('readonly');
        $("#background").removeAttr('readonly');
        $('#foreground').prop('disabled', false);
        $('#background').prop('disabled', false);
    }
    else
    {
        if(state == 'n')
        {
            $('#foreground').prop('readonly', true);
            $('#background').prop('readonly', true);
            $('#foreground').prop('disabled', true);
            $('#background').prop('disabled', true);
        }
        else
            alert("ERROR - customize color state: " + state);
    }
}
</script>

<!-- --------------------------------- -->
