$(function () {
    function compileTemplate (templateSelector, placeholderList) {
        var template = $(templateSelector).html();
        Object.keys(placeholderList).forEach(function (placeholderKey) {
            template = template.replaceAll('%' + placeholderKey + '%', placeholderList[ placeholderKey ]);
        });
        return template;
    }

    $('form').on('submit', function (event) {
        event.preventDefault();

        var url = event.target.elements.url.value;

        if (!url) alert('Please, provide an URL!');

        $.post('/url', {
            url: url,
            _token: CSRF_TOKEN
        }).done(function (data) {
            var resultTemplate = compileTemplate('#result-template', {
                shortened: data.url
            });
            $('#result').html(resultTemplate);
        }).fail(function (error) {
            alert(error.responseJSON.message);
        });
    });

    function getLastUrls () {
        $.get('/url', {
            _token: CSRF_TOKEN
        }).done(function (data) {
            var lastTenUrlsTemplate = '';

            data.urlList.forEach(function (url) {
                lastTenUrlsTemplate += compileTemplate('#last-urls-template', url);
            });

            $('#last-urls-list').html(lastTenUrlsTemplate);
        }).fail(function (error) {
            alert(error.responseJSON.message);
        });
    };

    getLastUrls();

    setInterval(getLastUrls, 10000);
});
