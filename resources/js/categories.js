$(function () {

    function switch_type(categorymenu_type) {
        var $text = $('.text_menu');
        var $pictures = $('.pictures_menu');
        switch (categorymenu_type) {
            case 'categorytext':
                console.log('categorytext');
                $pictures.hide();
                $text.css({display: 'flex'});
                $('.categorymenu-choice.picture').show();
                $('.categorymenu-choice.text').hide();
                break;
            case 'categorypicture':
                $pictures.show(1, function () {
                    $('.categorymenu-choice.text').show();
                });
                $text.hide();
                $('.categorymenu-choice.picture').hide();
                $('.categorymenu-choice.text').show();
                break;
        }
    }

    if (document.documentElement.clientWidth < 901) {
        $('.categorymenu-choice.text').css({display: 'flex'});
    }

    $('.categorymenu-choice').click(function () {
        if ($(this).hasClass('text')) {
            switch_type('categorytext');
        } else {
            switch_type('categorypicture');
        }
    });


});
