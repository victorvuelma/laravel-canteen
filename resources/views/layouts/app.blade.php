<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- CSS And JavaScript -->
        <link rel="stylesheet" href="{{ URL::asset('css/app.css') }}">
        <script defer src="{{ URL::asset('js/app.js') }}"></script>

        <title>Cantina{!! isset($title) ? ' - ' . $title : '' !!}</title>
    </head>

    <body>

        @yield('app_content')
    </body>
</html>