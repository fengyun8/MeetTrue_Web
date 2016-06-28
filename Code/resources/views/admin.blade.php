<!DOCTYPE html>
<html>
    <head>
        <title>Admin</title>
        <link rel="stylesheet" href="{{ asset('css/admin.css')}}">
    </head>
    <body class="admin">
        <main class="home">
            @include('global/sidebar')
            <div class="content">
                @yield('content')
            </div>
        </main>
    </body>
</html>
