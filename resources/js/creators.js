$(function () {

    $('body')
        .on('click', 'button.send_pdf', function () {
            var url = $(this).data('url');
            $.ajax({
                type: 'GET',
                url: url,
                success: function (response) {
                    if (response.message) {
                        _notify(response.message);
                    }
                }
            });
        })

});
