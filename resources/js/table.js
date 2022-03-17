function getUrl(url, parameters) {
    var url_parameters = [];
    var url_arr = url.split('?');
    if (url_arr[1]) {
        url_parameters = url_arr[1].split('&');
        url_parameters.forEach(function (item, ind) {
            if (item.indexOf('page') == 0 || item.indexOf('sort') == 0 || item.indexOf('only') == 0) {
                url_parameters.splice(ind);
            }
        });
    }
    url_parameters = url_parameters.concat(parameters);
    if (url_parameters.length > 0) {
        return url_arr[0] + '?' + url_parameters.join('&');
    }

    return url_arr[0];
}

function updateUrl(url) {
    history.pushState(null, null, url);
}

function refresh(url, filter, func) {
    $.ajax({
        type: 'GET',
        url: url,
        success: function (result) {
            var more = $('.pagination').data('more') == 1 ? true : false;
            if (!more) {
                $('.list').empty().html(result.html);
            }
            if (more) {
                $('.list').append(result.html);
            }
            $('.pagination').data('more', 0);
            if (result.pagecount >= 2 && $('.pagination div').length > 0) {
                $('.pagination input.page').val(result.pageid);
                $('.pagination span.pagecount').html(result.pagecount);
                $('.pagination').data('pagecount', result.pagecount);
            } else if (result.pagecount >= 2 && $('.pagination div').length <= 0 && result.pagination) {
                $('.pagination').empty().append(result.pagination);
            } else if (result.pagecount < 2) {
                $('.pagination').empty().append('<input type="hidden" class="page" value="1">');
            }
            if (result.pagecount > result.pageid) {
                $('.more_wrapper').append('<div class="more">Показать еще</div>');
            }
            if (func) {
                func(result);
            }
        },
        beforeSend: function () {
            $('.list').css({opacity: 0.5});
            $('.more_wrapper').empty();
        },
        complete: function () {
            $('.list').css({opacity: 1});
        }
    });
}


$(function () {

    $('input[type=number]').bind('mousewheel DOMMouseScroll', function () {
        return false;
    });

    $('body')
        .on('change', '.pagination input.page', function () {
            var change = false;
            var page = +$(this).val();
            var pagecount = +$(this).data('pagecount');
            var lastpage = +$(this).data('lastval');
            if (page >= 1 && page <= pagecount) {
                lastpage = page;
                change = true;
            } else {
                $('.pagination').data('more', 0);
            }
            $('.pagination input.page').val(lastpage).data('lastval', lastpage);
            if (change) {
                var parameters = [];
                if (page > 1) {
                    parameters.push('page=' + page);
                }
                if ($('.sortable').length > 0) {
                    var $sortable = $('.sortable');
                    if ($sortable.data('sortfield') != '' && $sortable.data('sortdirection') != '') {
                        parameters.push('sort=' + $sortable.data('sortdirection') + $sortable.data('sortfield'));
                    }
                }

                if ($('.sort.active').length > 0) {
                    parameters.push('sort=' + $('.sort.active').data('direction'));
                }
                var url = getUrl(location.pathname + location.search, parameters);
                updateUrl(url);
                refresh(url);
            }
        })
        .on('click', '.pagination .arrow', function () {
            var page = +$('.pagination input.page').eq(0).val();
            var new_page;
            if ($(this).hasClass('left')) {
                new_page = page - 1;
            }
            if ($(this).hasClass('right')) {
                new_page = page + 1;
            }
            $('.pagination input.page').eq(0).val(new_page).change();
        })
        .on('click', '.more', function () {
            $('.pagination').data('more', 1);
            $('.pagination .arrow.right').eq(0).click();
        })
        .on('click', '.sortable .sortby', function () {
            $('.sortby .sortsign').remove();
            $('.sortby').append('<i class="sortsign fas fa-sort"></i>');
            var sortfield = $(this).data('sortfield');
            var $parent = $(this).parents('.sortable');
            var parameters = [];
            if ($parent.data('sortfield') != sortfield) {
                $parent.data('sortfield', sortfield);
                $parent.data('sortdirection', 'asc');
                parameters.push('sort=asc' + sortfield);
                $(this).find('.sortsign').remove();
                $(this).append('<i class="sortsign fas fa-sort-up"></i>');
            } else if ($parent.data('sortfield') == sortfield && $parent.data('sortdirection') == 'asc') {
                $parent.data('sortdirection', 'desc');
                parameters.push('sort=desc' + sortfield);
                $(this).find('.sortsign').remove();
                $(this).append('<i class="sortsign fas fa-sort-down"></i>');
            } else if ($parent.data('sortfield') == sortfield && $parent.data('sortdirection') == 'desc') {
                $parent.data('sortfield', '');
                $parent.data('sortdirection', '')
            }
            var url = getUrl(location.pathname + location.search, parameters);
            updateUrl(url);
            refresh(url);
        })
        .on('click', '.std-table .tr .trash', function () {
            var $row = $(this).parents('.tr');
            var id = $row.data('id');
            var url = $(this).parents('.std-table').data('url') + '/' + id;
            var token = $(this).parents('.std-table').find('input[name="_token"]').val();
            $.ajax({
                type: 'DELETE',
                url: url,
                data: {
                    id: id,
                    _token: token
                },
                success: function (response) {
                    if (response.ok) {
                        $row.remove();
                    } else if (response.error) {
                        _notify(response.error);
                    }
                }, error: function (jqXHR, status) {
                    console.log(jqXHR);
                }
            });
        })
        .on('click', '.std-table.clickable .tr .td:not(.nofollow)', function () {
            var id = $(this).parents('.tr').data('id');
            var url = $(this).parents('.std-table').data('url');
            location.href = url + '/' + id + '/edit';
        })
})
;
