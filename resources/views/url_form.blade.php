<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>URL shortener</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" type="text/css" href="/css/app.css">
    </head>
    <body>
        <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
        <script type="text/javascript">
            var CSRF_TOKEN = '{{ csrf_token() }}';
        </script>

        <div class="content">
            <form class="shorten-url-form">
                <label>
                    <span>URL:</span>
                    <input placeholder="https://example.com" class="shorten-url-form__input" type="text" name="url">
                </label>
                <input  class="shorten-url-form__btn" type="submit" value="SUBMIT">

                <div id="result" class="shorten-url-form__result"></div>
            </form>

            <table class="last-urls-table">
                <thead>
                    <tr>
                        <th>Original URL</th>
                        <th>Shortened URL</th>
                    </tr>
                </thead>
                <tbody id="last-urls-list">
                </tbody>
            </table>

            <div id="result-template" class="hide">
                <span>Your shortened URL:</span>
                <span><a href="%shortened%" target="_blank">%shortened%</a></span>
            </div>

            <table>
                <tbody id="last-urls-template" class="hide">
                    <tr>
                        <td>
                            <a href="%original%" target="_blank">%original%</a>
                        </td>
                        <td>
                            <a href="%shortened%" target="_blank">%shortened%</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <script type="text/javascript" src="/js/app.js"></script>
    </body>
</html>
