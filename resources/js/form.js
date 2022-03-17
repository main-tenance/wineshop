$(function () {

    $('body')
        .on('click', '.std-form button.save', function () {
            console.log('.std-form button.save');
            var $form = $(this).parents('.std-form');
            var method = $form.data('method');
            var url = $form.data('url');
            var data = $form.find('input, textarea, select').serialize();
            console.log(url);
            console.log(method);
            console.log(data);
            $.ajax({
                type: method,
                url: url,
                data: data,
                success: function (response) {
                    console.log(response);
                    if (response.ok && response.id && method === 'POST') {
                        location.href = url + '/' + response.id + '/edit';
                    } else if (response.ok && response.message && method === 'PUT') {
                        _notify(response.message);
                    } else if (response.ok) {
                        console.log(method);
                        location.reload();
                    } else if (response.errors) {
                        let note = '';
                        for (let key in response.errors) {
                            note += '<div>' + response.errors[key] + '</div>';
                        }
                        _notify(note);
                    }
                }, error: function (jqXHR, status) {
                    var err = JSON.parse(jqXHR.responseText);
                    _notify(err.message);
                    console.log(err.errors);
                }
            });
        })

})
