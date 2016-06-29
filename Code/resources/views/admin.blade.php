<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin</title>
  <link rel="stylesheet" href="{{ asset('css/admin.css')}}">
</head>
<body class="admin">
  @include('svg.admin')
  <main class="home">
    @include('admin/sidebar')
    <div class="content">
      <p class="search">
        <svg class="svg svg__search"><use xlink:href="#search" /></svg>
        <input type="text" class="search__input btn__noStyle" placeholder="Search">
      </p>
      @yield('content')
    </div>
  </main>
</body>
</html>
