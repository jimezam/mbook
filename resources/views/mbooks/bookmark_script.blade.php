@push('scripts')

<script>
$(function () {
    $('[data-toggle="tooltip"]').tooltip();
})

function bookmark(book)
{
    var url = '{{ route("mbooks.bookmark", ":book") }}';
    url = url.replace(':book', book);

    $.ajax({
        url: url,
        type: "POST",
        dataType: "json",
        data: { _token: '{{ csrf_token() }}' },
        beforeSend: function(xhr) {
            $('#loading').modal('show');
        }
    })
    .done(function(data, textStatus, jqXHR) {
        var bookmark = $('#bookmark-'+book);
        var bookmarkSign = $('#bookmark_sign-'+book);

        if(data.bookmark)
        {
            bookmark.addClass('fas');
            bookmark.removeClass('far');
            bookmarkSign.tooltip('hide')
                .attr('data-original-title', 'Remover de los favoritos');
        }
        else
        {
            bookmark.addClass('far');
            bookmark.removeClass('fas');
            bookmarkSign.tooltip('hide')
                .attr('data-original-title', 'Agregar a los favoritos');
        }

        // $('[data-toggle="tooltip"]').tooltip();
    })
    .fail(function(jqXHR, textStatus, errorThrown) {
            alert("Error: " + errorThrown);
    })
    .always(function() { 
        $('#loading').modal('hide');
    });
}

function view(book, section, sheet)
{
    var url = '{{ route("mbooks.msections.msheets.view", [":book", ":section", ":sheet"]) }}';
    url = url.replace(':book', book);
    url = url.replace(':section', section);
    url = url.replace(':sheet', sheet);

    $.ajax({
        url: url,
        type: "POST",
        dataType: "json",
        data: { _token: '{{ csrf_token() }}' },
        beforeSend: function(xhr) {
            $('#loading').modal('show');
        }
    })
    .done(function(data, textStatus, jqXHR) {
        var view = $('#view-'+sheet);
        var viewSign = $('#view_sign-'+sheet);

        if(data.view)
        {
            view.addClass('fa-check-circle');
            view.removeClass('fa-circle');
            viewSign.tooltip('hide')
                .attr('data-original-title', 'Marcar como no visto aún');
        }
        else
        {
            view.addClass('fa-circle');
            view.removeClass('fa-check-circle');
            viewSign.tooltip('hide')
                .attr('data-original-title', 'Marcar como ya visto');
        }
    })
    .fail(function(jqXHR, textStatus, errorThrown) {
            alert("Error: " + errorThrown);
    })
    .always(function() { 
        $('#loading').modal('hide');
    });
}
</script>

@endpush