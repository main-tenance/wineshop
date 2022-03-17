import Cookies from 'js-cookie';
import fancybox from '@fancyapps/fancybox';

$(function () {

    // $('.detail_text_fb.update').fancybox({
    //     afterLoad: function () {
    //         $('#detail_text_textarea').htmlarea({
    //             toolbar: ['html', "bold", "italic", "underline", "link", "unlink"],
    //             loaded: function () {
    //                 this.html($('.product_reviews__content .detail_text').html());
    //             }
    //         });
    //     },
    //     beforeClose: function () {
    //         $('#detail_text_textarea').htmlarea('dispose');
    //     }
    // });
    //
    // $('.detail_picture_fb.update').fancybox({
    //     afterLoad: function () {
    //         if ($('input[type="radio"][name="picture"]')) {
    //             $('#detail_picture input[name="picture_type"]').val($('.detail_picture_upload input[name="picture"]:checked').val());
    //         }
    //     },
    //     beforeClose: function () {
    //
    //     }
    // });


    function init_promo_popup() {
        var instance = $.fancybox.getInstance();
        if (!(instance && instance.current.src == '#registration')) {
            doWithYaCounter(show_promo_popup);
        }
    }


    var show_promo_footer = function () {
        var ya_client_id = yaCounter50258335.getClientID();
        $.ajax({
            type: 'GET',
            url: '/main/get_ya_client_sale_discount_popup/',
            data: {
                YA_CLIENT_ID: ya_client_id
            },
            success: function (response) {
                var result = JSON.parse(response);
                if (result.popup) {
                    $('#footer_promo').css({display: 'block'});
                }
            }
        });

    }

    var show_promo_popup = function () {
        var ya_client_id = yaCounter50258335.getClientID();
        $.ajax({
            type: 'GET',
            url: '/main/get_ya_client_sale_discount_popup/',
            data: {
                YA_CLIENT_ID: ya_client_id
            },
            success: function (response) {
                var result = JSON.parse(response);
                if (result.popup) {
                    $.fancybox.open($('#first_order_promo'), {
                        beforeLoad: function () {
                            $('#first_order_promo .popup__text_1').html(result.popup);
                        },
                        afterShow: function () {
                            Cookies.remove('show_promo_popup');
                            var d = new Date();
                            var t = d.toString();
                            yaCounter50258335.params({promo: {discount_id: result.ID, show_time: t}});
                        },
                        beforeClose: function (instance, current, e) {
                            if (e && e.target && $(e.target).hasClass('fancybox-close-small')) {
                                $('#footer_promo').css({display: 'block'});
                            }
                        }
                    });
                }
            }
        });
    }


    if (!Cookies.get('age')) {
        $.fancybox.open($('#age'), {modal: true});
    } else if (Cookies.get('age') && Cookies.get('show_promo_popup')) {
        var delta = Cookies.get('show_promo_popup') - Date.now();
        if (delta <= 0) {
            init_promo_popup();
        } else {
            setTimeout(function () {
                init_promo_popup();
            }, delta);
        }
    } else if (Cookies.get('age') && Cookies.get('show_promo_footer')) {
        doWithYaCounter(show_promo_footer);
    }

    $('.js-age-yes').click(function (e) {
        $.fancybox.close();
        Cookies.set('age', 'true', {path: '/'});
        Cookies.set('show_promo_popup', (Date.now() + 10000), {path: '/'});
        Cookies.set('show_promo_footer', 1, {path: '/'});
        setTimeout(function () {
            init_promo_popup();
        }, 10000);
    });

    $('.js-age-no').click(function (e) {
        $.fancybox.close();
        $.fancybox.open($('#no-age'), {modal: true});
        $('.fancybox-bg').css('opacity', 1);
    });

    $('.popup__button .no_reg').click(function (e) {
        $.fancybox.close();
        $('#footer_promo').css({display: 'block'});
    });

    $('#footer_promo').click(function () {
        $('#footer_promo').css({display: 'none'});
        doWithYaCounter(show_promo_popup);
    });


});


