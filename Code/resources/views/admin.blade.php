<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css')}}">
</head>
<body>
    @include('admin.components.sidebar')
    <div class="container">
        <div class="content">
            @yield('content')
        </div>
    </div>
</body>
</html>
