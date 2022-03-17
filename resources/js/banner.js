$(function () {

    if ($('.js-owl-main-slider').length > 0) {
        $('.js-owl-main-slider')
            .css({
                display: 'block'
            })
            .slick({
            infinite: true,
            speed: 500,
            fade: true,
            cssEase: 'linear',
            slidesToShow: 1,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 2000,
            arrows: false,
            dots: true
        });
    }

});
