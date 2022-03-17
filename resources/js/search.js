export const BigSearch = function (arParams) {

    var _this = this;
    var window_width = $('.header__bottom').width();
    var result_width = window_width < 900 ? window_width : $('#big_search_wrapper').width();

    this.arParams = {
        'MIN_QUERY_LEN': parseInt(arParams.MIN_QUERY_LEN)
    };

    this.INPUT = null;
    this.cache = [];
    this.cache_key = null;

    this.ShowResult = function (result) {
        if (result != null) {
            _this.RESULT.html(result);
        }
        if (_this.RESULT.html().length > 0) {
            _this.RESULT.slideDown(300);
        }
    }

    this.onFocusLost = function (hide) {
        setTimeout(function () {
            _this.RESULT.slideUp(300);
        }, 250);
    }

    this.onFocusGain = function () {
        if (_this.RESULT.html().length > 0 && _this.INPUT.val().length > 0 && _this.INPUT.val().trim().length > 0) {
            _this.ShowResult();
        }
    }

    this.onTimeout = function () {
        var current_input = _this.INPUT.val();
        if (current_input != _this.oldValue) {
            if (current_input.length >= _this.arParams.MIN_QUERY_LEN) {
                _this.oldValue = current_input;
                _this.cache_key = current_input;
                if (_this.cache[_this.cache_key] == null) {
                    var url = '/'+ document.documentElement.lang + '/search/popup/';
                    $.ajax({
                        type: 'GET',
                        url: url,
                        data: {
                            q: _this.oldValue,
                            INPUT: arParams.INPUT,
                            ajax: true
                        },
                        success: function (response) {
                            _this.cache[_this.cache_key] = response;
                            _this.ShowResult(response);
                            setTimeout(_this.onTimeout, 500);
                        }
                    });
                } else {
                    _this.ShowResult(_this.cache[_this.cache_key]);
                    setTimeout(_this.onTimeout, 500);
                }
            } else {
                _this.onFocusLost();
                setTimeout(_this.onTimeout, 500);
            }
        } else {
            setTimeout(_this.onTimeout, 500);
        }
    }

    this.Init = function () {
        this.INPUT = $('input[name="' + arParams.INPUT + '"]');
        this.RESULT = $(arParams.RESULT);
        this.PARENT = arParams.PARENT;
        this.SEARCH_FIELD = arParams.SEARCH_FIELD;
        var window_width = $('.header__bottom').width();
        var result_width = window_width < 900 ? window_width : $('#big_search_wrapper').width();
        _this.RESULT.css({width: result_width});
        $(document)
            .on('keydown', function (e) {
                if (e == null) {
                    var k = event.keyCode;
                } else {
                    var k = e.which;
                }
                if (k == 27) {
                    _this.onFocusLost();
                }
            })
            .on('click', function (e) { // закрытие по клику вне элемента
                if ($(e.target).parents(_this.PARENT).length == 0 || $(e.target).hasClass('addtobasket')) {
                    _this.onFocusLost();
                } else if ($(e.target).parents(_this.SEARCH_FIELD).length > 0) {
                    _this.onFocusGain();
                }
            });

        setTimeout(this.onTimeout, 500);
    }

    $(function () {
        _this.Init();
    });
}

export const SearchSearch = function (arParams) {
    var _this = this;

    this.arParams = {
        'MIN_QUERY_LEN': parseInt(arParams.MIN_QUERY_LEN)
    };

    this.PAGE = null;
    this.INPUT = null;
    this.cache = [];
    this.cache_key = null;

    this.ShowResult = function (result) {
        if (!result) {
            return false;
        }

        _this.RESULT.html(result);
        if (_this.RESULT.html().length > 0) {
            _this.RESULT.slideDown(300);
        }
    }

    this.onFocusLost = function (hide) {
        setTimeout(function () {
            _this.RESULT.slideUp(300);
        }, 250);
    }

    this.onFocusGain = function () {
        if (_this.RESULT.html().length > 0 && _this.INPUT.val().trim().length > 0) {
            _this.ShowResult();
        }
    }

    this.onTimeout = function () {
        var current_page = _this.PAGE ? +_this.PAGE.val() : null;
        var current_input = _this.INPUT.val().trim();
        if (current_input != _this.oldValue) {
            if (current_page) {
                current_page = 1;
                _this.PAGE.val(1);
            }
        }
        if (current_input != _this.oldValue || current_page != _this.oldPage) {
            if (current_input.length >= _this.arParams.MIN_QUERY_LEN) {
                _this.oldPage = current_page;
                _this.oldValue = current_input;
                _this.cache_key = current_input + '--' + current_page;
                if (_this.cache[_this.cache_key] == null) {
                    $.ajax({
                        type: 'GET',
                        url: '/search/search/',
                        data: {
                            q: _this.oldValue,
                            page: _this.oldPage,
                            input: _this.INPUTNAME,
                            ajax: true
                        },
                        success: function (response) {
                            try {
                                var result = JSON.parse(response);
                            } catch (e) {
                                alert('Что-то пошло не так. Попробуйте обновить страницу.');
                            }
                            _this.cache[_this.cache_key] = result.html;
                            _this.ShowResult(result.html);
                            setTimeout(_this.onTimeout, 500);
                        }
                    });

                } else {
                    _this.ShowResult(_this.cache[_this.cache_key]);
                    setTimeout(_this.onTimeout, 500);
                }

            } else {
                setTimeout(_this.onTimeout, 500);
            }
        } else {
            setTimeout(_this.onTimeout, 500);
        }
    }

    this.Init = function () {
        this.INPUTNAME = arParams.INPUT;
        this.INPUT = $('input[name="' + arParams.INPUT + '"]');
        if (arParams.PAGE) {
            this.PAGE = $('input[name="' + arParams.PAGE + '"]');
        }
        this.RESULT = $(arParams.RESULT);
        this.PARENT = arParams.PARENT;
        this.SEARCH_FIELD = arParams.SEARCH_FIELD;

        $(document)
            .on('keydown', function (e) {
                if (e == null) {
                    k = event.keyCode;
                } else {
                    k = e.which;
                }
                if (k == 27) {
                    _this.onFocusLost();
                }
            })
            .on('click', function (e) { // закрытие по клику вне элемента
                if ($(e.target).parents(_this.PARENT).length == 0) {
                    _this.onFocusLost();
                } else if ($(e.target).parents(_this.SEARCH_FIELD).length > 0) {
                    _this.onFocusGain();
                }
            });

        setTimeout(this.onTimeout, 500);
    }

    $(function () {
        _this.Init();
    });
}
