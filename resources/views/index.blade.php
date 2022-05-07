<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Yo Mail</title>

        <link rel="icon" href="{{ asset('vendor/yomail/yomailfavicon.ico') }}">



        <link href="{{ asset('vendor/yomail/yomail.css') }}" rel="stylesheet" />




    <script>
        window.yomail = {
            'route' : '{{Config::get('yomail.route')}}',
            'refresh' : '{{Config::get('yomail.refresh')}}',
        };
    </script>


    </head>
    <body class="antialiased h-full">
                <div id="app"></div>
                <script src="{{ asset('vendor/yomail/yomail.js') }}" defer></script>

    </body>
</html>
