import { BigSearch, SearchSearch } from './search';
import svg4everybody from 'svg4everybody';

function removeURLParameter(url, parameter) {
    var urlparts = url.split('?');
    if (urlparts.length >= 2) {
        var prefix = encodeURIComponent(parameter) + '=';
        var pars = urlparts[1].split(/[&;]/g);
        for (var i = pars.length; i-- > 0;) {
            //idiom for string.startsWith
            if (pars[i].lastIndexOf(prefix, 0) !== -1) {
                pars.splice(i, 1);
            }
        }
        return urlparts[0] + (pars.length > 0 ? '?' + pars.join('&') : '');
    }
    return url;
}


function doWithYaCounter(closure) {
    var result = false;
    if (typeof yaCounter50258335 !== 'undefined') {
        result = closure();
        return result;
    }
    var timerId = setInterval(function () {
        if (typeof yaCounter50258335 !== 'undefined') {
            clearInterval(timerId);
            result = closure();
            return result;
        }
    }, 1000);
}

function reachGoal(goal) {
    doWithYaCounter(function () {
        yaCounter50258335.reachGoal(goal);
    });
}


function get_search_list() {
    var str = location.search;
    var arr = str.match(/\?q=[^&]+/g);
    var url = '/search/';
    if (arr !== null) {
        url += arr[0];
    }
    var parameters = [];
    var sign = '?';
    if (url.search(/\?/) !== -1) {
        sign = '&';
    }
    if (page > 1) {
        parameters.push('page=' + page);
    }
    if (parameters.length > 0) {
        url += sign + parameters.join('&');
    }
    history.pushState(null, null, url);
    $.ajax({
        type: 'GET',
        url: url,
        data: {
            ajax: true
        },
        success: function (response) {
            var list = JSON.parse(response);
            $('.pagination').data('pagecount', list.pagecount);
            $('.pagination span.pagecount').html(list.pagecount);
            $('input.page').val(list.pageid);

            if (list.pagecount >= 2 && $('.pagination div').length > 0) {
                $('.pagination input.page').val(list.pageid);
                $('.pagination span.pagecount').html(list.pagecount);
                $('.pagination').data('pagecount', list.pagecount);
            } else if (list.pagecount >= 2 && $('.pagination div').length <= 0) {
                $('.pagination').empty().append('<div>Страница</div>' +
                    '                <div class="form__range">' +
                    '                    <input class="page" type="number" value="' + list.pageid + '" min="1"' +
                    '                           max="' + list.pagecount + '">' +
                    '                </div>' +
                    '                <div>' +
                    '                    из <span class="pagecount">' + list.pagecount + '</span>' +
                    '                </div>' +
                    '                <div class="catalog_pagination__arrows">' +
                    '                    <span class="arrow left" href=""><i class="fas fa-arrow-left"></i></span>' +
                    '                    |' +
                    '                    <span class="arrow right" href=""><i class="fas fa-arrow-right"></i></span>' +
                    '                </div>');
            } else if (list.pagecount < 2) {
                $('.pagination').empty().append('<input type="hidden" class="page" value="1">');
            }

            if (!more) {
                $('.user_catalog .search_list').empty().html(list.html);
            }
            if (more) {
                $('.user_catalog .search_list').append(list.html);
            }
            $('.user_catalog .search_list').css({opacity: 1});
            if (list.pagecount > list.pageid) {
                $('.more_wrapper').append('<div class="more">Показать еще</div>');
            }
        },
        beforeSend: function () {
            $('.user_catalog .search_list').css({opacity: 0.5});
            $('.more_wrapper').empty();
        }
    });
};


$(function () {

    var header_search = new BigSearch({
        'MIN_QUERY_LEN': 3,
        'INPUT': 'q',
        'RESULT': '#search_result',
        'PARENT': '#big_search_wrapper',
        'SEARCH_FIELD': '.search_field'
    });

    svg4everybody();

    $(document).ajaxStart(function () {
        $(document.body).css({'cursor': 'wait'});
    }).ajaxStop(function () {
        $(document.body).css({'cursor': 'default'});
    });

    $('#big_search_wrapper .search_fa').click(function () {
        $(this).parents('form').submit();
    });


})
