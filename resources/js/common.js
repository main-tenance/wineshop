import Cookies from 'js-cookie';

function showMessage(top, left, width, message) {
    var $tooltip = $('<div class="header-window"><div class="header-window-message">' + message + '</div><img src="/images/img/exit.svg" class="exit"></div>').appendTo('body');
    $tooltip
        .css('top', top)
        .css('left', left)
        .css('width', width)
        .fadeTo(300, 1);
}

window._notify = function (text) {
    $.fancybox.open({
        src: '#notify',
        type: 'inline',
        opts: {
            beforeLoad: function () {
                $('#notify .popup-inner').html(text);
            },
            afterLoad: function () {
                // setTimeout(function () {
                //     parent.$.fancybox.close();
                // }, 10000);
            }
        }
    });
}

function unique(array) {
    return array.filter(function (el, index, arr) {
        return index == arr.indexOf(el);
    });
}

$(document).ready(function () {

    if (!Cookies.get('subscriber') && !Cookies.get('subscriber-popup')) {
        $('.advertising').css({display: 'block'});
    }

    $('body')
        .on('click', '.advertising .advertising__button-drop', function () {
            Cookies.set('subscriber-popup', 'n');
            $('.advertising').animate({bottom: '-150px'});
        })
        .on('mouseenter', '.btns .cart', function () {
            return false;

            if ($(window).width() <= 760) {
                return false;
            }
            var $this = $(this);
            if (!$this.is(':hover')) {
                return false;
            }
            $.ajax({
                type: 'GET',
                url: '/cart/get_basket_popup/',
                success: function (response) {
                    var result = JSON.parse(response);
                    if (result.html) {
                        // var rt = ($(window).width() - ($this.offset().left + $this.width()));
                        var rt = $('.head').offset().left;
                        var tooltipText = result.html;
                        var $tooltip = $('<div class="header-window cart-window">' + tooltipText + '</div>').appendTo('body');
                        var maxwidth_r = Math.min(($(window).width() - rt), 300);
                        $tooltip
                            .css('top', $this.offset().top)
                            .css('right', rt)
                            .css('max-width', maxwidth_r + 'px')
                            .fadeTo(300, 1)
                    }
                }
            });

        })
        .on('mouseleave', '.header-window.cart-window', function () {
            $(this).fadeTo(300, 0, function () {
                $(this).remove();
            });
        })
        .on('click', '.header-window .cart-mini .minus', function () {
            var $input = $(this).parent().find('input');
            var count = parseInt($input.val()) - 1;
            count = count < 1 ? 1 : count;
            $input.val(count);
            $input.change();
        })
        .on('click', '.header-window .cart-mini .plus', function () {
            var $input = $(this).parent().find('input');
            var max = +$input.prop('max');
            var count = parseInt($input.val()) + 1;
            count = count > max ? max : count;
            $input.val(count);
            $input.change();
        })
        .on('change', '.header-window .cart-mini input', function () {
            var $this = $(this);
            var quantity = $this.val();
            var product_id = $this.data('product_id');
            var basket_id = $this.data('basket_id');
            $.ajax({
                type: 'POST',
                url: '/cart/update_quantity_in_basket/',
                data: {
                    BASKET_ID: basket_id,
                    PRODUCT_ID: product_id,
                    QUANTITY: quantity
                },
                success: function (response) {
                    $.ajax({
                        type: 'GET',
                        url: '/cart/get_basket_popup/',
                        success: function (response) {
                            var result = JSON.parse(response);
                            if (result.html) {
                                $this.parents('.header-window').html(result.html);
                            }
                        }
                    });
                }

            });
        })
        .on('click', '.header-window .exit', function () {
            $(this).parents('.header-window').fadeTo(300, 0, function () {
                $(this).remove();
            });
        })
        // .on('click', '.header-window .reg', function () {
        //     $(this).parents('.header-window').remove();
        // })
        // .on('mouseenter', '.mainmenu ul li', function () {
        //     var $this = $(this);
        //     if (['gin', 'vodka', 'rom', 'calvados'].includes($this.data('category_code'))) {
        //         return false;
        //     }
        //
        //     $.ajax({
        //         type: 'GET',
        //         url: '/main/get_category_popup/',
        //         data: {
        //             category_id: $this.data('category_id'),
        //             category_code: $this.data('category_code')
        //         },
        //         success: function (response) {
        //             console.log(response);
        // var result = JSON.parse(response);
        // if (result.html) {
        //     var left = $('.head').offset().left;
        //     var maxwidth = $('.head').width();
        //     var top = $this.offset().top + $this.height();
        //     var tooltipText = result.html;
        //     if (!$this.is(':hover')) {
        //         return false;
        //     }
        //     var $tooltip = $('<div class="category-popup">' + tooltipText + '</div>').appendTo('body');
        //     $tooltip
        //         .css('top', top)
        //         .css('left', left)
        //         .css('max-width', maxwidth + 'px')
        //         .fadeTo(300, 1);
        // }
        //         }
        //     });
        // })
        .on('mouseleave', '.mainmenu ul li', function () {
            if ($('.category-popup').length === 0 || $('.category-popup:hover').length === 0) {
                $('.category-popup').remove();
            }
        })
        .on('mouseleave', '.category-popup', function () {
            $('.category-popup').remove();
        })
        .on('click', '.subscribe button', function () {
            var email = $(this).parents('.subscribe').find('input[type="email"]').val();
            var $this = $(this);
            $.ajax({
                type: 'POST',
                url: '/main/subscribe/',
                data: {
                    email: email
                },
                success: function (response) {
                    var result = JSON.parse(response);
                    var top = $this.offset().top - 80;
                    var left = $('.subscribe').offset().left;
                    var width = $('.subscribe').width;
                    var tooltipText = result.html;
                    var $tooltip = $('<div class="header-window subscribe-window">' + tooltipText + '</div>').appendTo('body');
                    $tooltip
                        .css('top', top)
                        .css('left', left)
                        .css('width', width)
                        .fadeTo(300, 1);
                }
            });
        })
        .on('mouseenter', '.level-1', function () {
            var offset = +this.getBoundingClientRect().x;
            var width1 = +$(this).outerWidth();
            var width2 = +$(this).find('.level-2').outerWidth();
            var screen_width = +document.documentElement.clientWidth;
            var delta = screen_width - offset - width2;
            var left = offset;
            if (delta < 0) {
                left = offset + width1 - width2;
            }
            $(this).find('.level-2').css({left: left});
        })
        .on('mouseleave', '.level-1', function () {
            $('.level-2').css({left: '-200vh'});
        })


    $(".window input").keypress(function () {
        var logval = $("#login").val();
        var loglen = logval.length;
        var passval = $("#password").val();
        var passlen = passval.length;


        if (loglen > 0 && passlen > 0) {
            $('#enter').prop("disabled", false);
            $('.window').addClass('valid');
        } else {
            $('#enter').prop("disabled", true);
            $('.window').removeClass('valid');
        }
    });

    $('#count').on('change', '', function (e) {
        var vall = $(this).val();
        if (vall == 'more') {
            $('.price-block .count .select-outer').addClass('hidden');
            $('.price-block .count .in').removeClass('hidden');
        }
    });

    $(".full-descr a.detail-title").click(
        function () {
            $(this).closest('.full-descr').toggleClass('open');
            $(this).closest('.full-descr').find('.text').slideToggle();
            return false;
        }
    )
    $(".link-nav").click(
        function () {
            $('.topmenu').toggleClass('visible');
            return false;
        }
    )

    $(".category-popup .all").click(
        function () {
            $(this).closest('ul').toggleClass('open');
            $(this).toggleClass('opened');
            return false;
        }
    )

    let windowW = $(window).width();

    if (windowW < 801) {

        $('.topmenu li:has(ul)').addClass('menu-parent');
        $('li.menu-parent').append('<span class="str"></span>');

        $("a:contains('ВИНО')").parent().addClass('vine-link');
        $('li.vine-link').append('<span class="str-v"></span>');

        $('.flex-it .price-block').insertAfter('.gallery');


        $(".topmenu ul li.menu-parent .str").click(
            function () {
                $(this).closest('li').find('ul').slideToggle();
                $(this).closest('li').toggleClass('open');
                return false;
            }
        )

        $(".topmenu ul li.menu-parent .str-v").click(
            function () {
                $('.category-popup').addClass('open-mobile');
                $('.mainmenu').addClass('static');
                return false;
            }
        )

        $(".category-popup .exit").click(
            function () {
                $('.category-popup').removeClass('open-mobile');
                $('.mainmenu').removeClass('static');
                return false;
            }
        )
    }

});




