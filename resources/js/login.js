$(function () {

    $('body')
        .on('click', '.head .right .btns .enter', function (e) {
            var $this = $(this);
            var url = '/' + $('.global_wrapper').data('locale') + '/get_login_popup';
            $.ajax({
                type: 'GET',
                url: url,
                success: function (response) {
                    var rt = 20, top = 20, maxwidth_r = 300;
                    if ($(window).width() > 760) {
                        maxwidth_r = Math.min(($(window).width() - rt), 300);
                        top = $this.offset().top;
                        rt = $('.head').offset().left;
                    }
                    var $tooltip = $('<div class="header-window login-window">' + response + '</div>').appendTo('body');
                    $tooltip
                        .css('top', top)
                        .css('right', rt)
                        .css('max-width', maxwidth_r + 'px')
                        .fadeTo(300, 1)

                }
            });
        })
        .on('click', '.login__form button[type="submit"]', function (e) {
            e.preventDefault();
            var url = '/' + $('.global_wrapper').data('locale') + '/login';
            var $formError = $(this).parents('.login__form').find('.form__row.form__row__error');
            var data = $(this).parents('form').serialize();
            $formError.empty();
            $.ajax({
                type: 'POST',
                url: url,
                data: data,
                success: function (result) {
                    if (result.errors) {
                        for (let key in result.errors) {
                            $formError.append($('<div class="form__error"></div>').html(result.errors[key]));
                        }
                        $formError.slideDown(400, function () {
                            setTimeout(function () {
                                $formError.slideUp(400, function () {
                                    $formError.empty();
                                });
                            }, 3000);
                        });
                    } else if (result.ok) {
                        location.reload();
                    }
                }
            });
        })
        .on('click', '.open_login_popup', function () {
            fb_instance = $.fancybox.open({
                src: '#login',
                type: 'inline',
                opts: {
                    afterShow: function (instance, current) {
                    },
                }
            });
        })
        .on('click', '.logout', function () {
            var data = $(this).parents('form').serialize();
            $.ajax({
                type: 'POST',
                url: '/logout',
                data: data,
                success: function (result) {
                    location.reload();
                }
            });
        })


})
