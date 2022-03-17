$(function () {

    $('body')
        .on('click', '.registration_fb', function () {
            var url = $(this).data('url');
            $(this).parents('.header-window').remove();
            fb_instance = $.fancybox.open({
                src: '#registration',
                type: 'inline',
                opts: {
                    beforeShow: function () {
                        $.ajax({
                            type: 'GET',
                            url: url,
                            success: function (response) {
                                $('.popup-inner').html(response);
                            }
                        });
                    }
                }
            });
        })
});
