<!DOCTYPE html>
<html>
    <head>
        <title>Laravel</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <link rel="stylesheet" href="{{ asset('css/app.css')}}">
    </head>
    <body>
        @include('svg.all')
        <div class="container">
            <div class="content">
                @yield('content')
            </div>
        </div>
    </body>
</html>
