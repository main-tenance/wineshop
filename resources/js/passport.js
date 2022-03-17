$(function () {

    if ($('#passport-clients').length === 1) {
        $.ajax({
            type: 'GET',
            url: '/oauth/clients',
            success: function (response) {
                $(response).each(function (i, item) {
                    $('#passport-clients').append('<div class="passport-client-row ' + item.id + '">' +
                        '<div class="passport-client-name">' + item.name + '</div>' +
                        '<div class="passport-client-id">' + item.id + '</div>' +
                        '<div class="passport-client-secret">' + item.secret + '</div>' +
                        '<div class="passport-client-redirect">' + item.redirect + '</div>' +
                        '<div class="passport-client-edit" data-id="' + item.id + '"><i class="fas fa-pen"></i></div>' +
                        '<div class="passport-client-delete" data-id="' + item.id + '"><i class="fas fa-trash-alt"></i></div>' +
                        '</div>');
                });
            }
        });
    }

    if ($('#personal-tokens').length === 1) {
        $.ajax({
            type: 'GET',
            url: '/oauth/personal-access-tokens',
            success: function (response) {
                $(response).each(function (i, item) {
                    $('#personal-tokens').append('<div class="personal-token-row ' + item.id + '" data-id="' + item.id + '">' +
                        '<div class="personal-token-name">' + item.name + '</div>' +
                        '<div class="personal-token-scopes">' + item.scopes.join(", ") + '</div>' +
                        '<div class="personal-token-created_at">' + item.created_at + '</div>' +
                        '<div class="personal-token-expires_at">' + item.expires_at + '</div>' +
                        '<div class="personal-token-delete" data-id="' + item.id + '"><i class="fas fa-trash-alt"></i></div>' +
                        '</div>');
                });
            }
        });
        $.ajax({
            type: 'GET',
            url: '/oauth/scopes',
            success: function (response) {
                $(response).each(function (i, item) {
                    $('#scopes').append('<div class="scope-row">' +
                        '<div class="scope-checkbox"><input type="checkbox" name="scopes[' + i + ']" value="' + item.id + '"></div>' +
                        '<div class="scope-description">' + item.description + '</div>' +
                        '</div>');
                });
            }
        });
    }

    $('body')
        .on('click', 'button.create-passport-client', function () {
            var $redirect = $('#create-passport-client #redirect input');
            $redirect.val(encodeURI($redirect.val()));
            var data = $('#create-passport-client input').serialize();
            $.ajax({
                type: 'POST',
                url: '/oauth/clients',
                data: data,
                success: function (response) {
                    var item = response;
                    $('#passport-clients').append('<div class="passport-client-row ' + item.id + '">' +
                        '<div class="passport-client-name">' + item.name + '</div>' +
                        '<div class="passport-client-id">' + item.id + '</div>' +
                        '<div class="passport-client-secret">' + item.secret + '</div>' +
                        '<div class="passport-client-redirect">' + item.redirect + '</div>' +
                        '<div class="passport-client-edit"><i class="fas fa-pen"></i></div>' +
                        '<div class="passport-client-delete" data-id="' + item.id + '"><i class="fas fa-trash-alt"></i></div>' +
                        '</div>');
                    parent.$.fancybox.close();
                }
            });
        })
        .on('click', 'button.update-passport-client', function () {
            var client_id = $('#update-passport-client #id input').val();
            var $redirect = $('#update-passport-client #redirect input');
            $redirect.val(encodeURI($redirect.val()));
            var data = $('#update-passport-client input').serialize();
            var $row = $('#passport-clients .' + client_id);
            $.ajax({
                type: 'PUT',
                url: '/oauth/clients/' + client_id,
                data: data,
                success: function (response) {
                    var item = response;
                    $row.find('.passport-client-name').html(item.name);
                    $row.find('.passport-client-redirect').html(item.redirect);
                    parent.$.fancybox.close();
                }
            });
        })
        .on('click', '.passport-client-delete', function () {
            var $row = $(this).parents('.passport-client-row');
            var client_id = $row.find('.passport-client-id').html();
            var data = $('#update-passport-client input').serialize();
            $.ajax({
                type: 'DELETE',
                url: '/oauth/clients/' + client_id,
                data: data,
                success: function (response) {
                    $row.remove();
                }
            });
        })
        .on('click', '.passport-client-edit', function () {
            var $row = $(this).parents('.passport-client-row');
            var client_id = $row.find('.passport-client-id').html();
            var name = $row.find('.passport-client-name').html();
            var redirect = $row.find('.passport-client-redirect').html();
            fb_instance = $.fancybox.open({
                src: '#update-passport-client',
                type: 'inline',
                opts: {
                    beforeShow: function () {
                        $('#update-passport-client #id input').val(client_id);
                        $('#update-passport-client #name input').val(name);
                        $('#update-passport-client #redirect input').val(redirect);
                    }
                }
            });
        })
        .on('click', 'button.create-personal-token', function () {
            var data = $('#create-personal-token input').serialize();
            $.ajax({
                type: 'POST',
                url: '/oauth/personal-access-tokens',
                data: data,
                success: function (response) {
                    parent.$.fancybox.close();
                    if (response.accessToken) {
                        var item = response.token;
                        $('#personal-tokens').append('<div class="personal-token-row ' + item.id + '" data-id="' + item.id + '">' +
                            '<div class="personal-token-name">' + item.name + '</div>' +
                            '<div class="personal-token-scopes">' + item.scopes.join(", ") + '</div>' +
                            '<div class="personal-token-created_at">' + item.created_at + '</div>' +
                            '<div class="personal-token-expires_at">' + item.expires_at + '</div>' +
                            '<div class="personal-token-delete" data-id="' + item.id + '"><i class="fas fa-trash-alt"></i></div>' +
                            '</div>');
                        fb_instance = $.fancybox.open({
                            src: '#show-personal-token',
                            type: 'inline',
                            opts: {
                                beforeShow: function () {
                                    $('#show-personal-token #personal-token').html(response.accessToken);
                                }
                            }
                        });
                    }
                }
            });
        })
        .on('click', '.personal-token-delete', function () {
            var $row = $(this).parents('.personal-token-row');
            var token_id = $row.data('id');
            var data = $('#create-personal-token input').serialize();
            $.ajax({
                type: 'DELETE',
                url: '/oauth/personal-access-tokens/' + token_id,
                data: data,
                success: function (response) {
                    $row.remove();
                }
            });
        })

});
