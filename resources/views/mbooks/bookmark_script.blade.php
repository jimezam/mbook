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
</script>

@endpush