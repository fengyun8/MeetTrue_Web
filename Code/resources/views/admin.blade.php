<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css')}}">
</head>
<body class="admin">
  <main class="index">
    @include('admin/sidebar')
    <div class="content">
      @yield('content')
    </div>
  </main>
</body>
</html>
