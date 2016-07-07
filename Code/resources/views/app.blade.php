<!DOCTYPE html>
<html>
  <head>
    <title>@yield('title') | 觅处 | Meet-True</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link rel="stylesheet" href="{{ asset('css/app.css')}}">
  </head>
  <body class="@yield('body-class')" data-module="search @yield('module')">
    @include('svg.all')
    @include('shared.nav')
    @yield('below-nav')
    <div class="content" id="app">
      <div class="surface">
        @yield('content')
<!--         <span class="btn__select">
          <input type="text" value="123" placeholder="专业">
          <button type="button"></button>
          <ul>
            <li>123</li>
            <li>456</li>
            <li>789</li>
          </ul>
        </span> -->
      </div>
    </div>
    @include('shared.footer')
  <script src="{{ asset('js/app.js')}}"></script>
</body>
</html>
