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
    {!! Form::label('background', 'Color de fondo', ['class' => 'control-label']) !!}
    <input type="color" id="background" name="background" value="{{ old('background', $background) }}" class="form-control">
</div>

<!-- --------------------------------- -->

@push('scripts')

<script src="{{ asset('js/tinymce/tinymce.min.js') }}"></script>

<script>
$(document).ready(function() {
    manageColorsCustomizeState($('#customize').val());

    $('#customize').change(function() {
        manageColorsCustomizeState(this.value);
    });

    tinymce.init({ 
        selector:'#contents',
        schema: 'html5',
        theme: 'modern',
        mobile: { 
            theme: 'mobile',
            // plugins: [ 'autosave', 'lists', 'autolink' ],        // https://www.tiny.cloud/docs/plugins/
            // toolbar: [ 'undo', 'bold', 'italic', 'styleselect' ]     // https://www.tiny.cloud/docs/mobile/
        },
        skin: 'lightgray',
        language: 'es_MX',      // https://www.tiny.cloud/docs/general-configuration-guide/localize-your-language/
        // width: 600,
        // height: 300,
        // max_height: 500,
        // max_width: 500,
        // min_height: 100,
        // min_width: 400,
        // content_css: 'css/content.css',
        statusbar: true,
        inline: false,
        plugins: 'code, lists, advlist, anchor, autolink, charmap, emoticons, fullscreen, link, preview, searchreplace, table, visualblocks, wordcount',
        toolbar: [
            'styleselect formatselect fontselect fontsizeselect | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | blockquote subscript superscript removeformat | link anchor',
            'undo redo | searchreplace | bullist numlist outdent indent | table | emoticons charmap | visualblocks fullscreen code preview'
        ],
        menubar: false,
        browser_spellcheck: true,
        contextmenu: false,
    
        // code_dialog_height: 300,
        // code_dialog_width: 350,
        link_context_toolbar: true,
        // plugin_preview_height: 500,
        // plugin_preview_width: 650,
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

@endpush

<!-- --------------------------------- -->
