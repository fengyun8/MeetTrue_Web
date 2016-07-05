<!DOCTYPE html>
<html>
    <head>
        <title>@yield('title') | 觅处 | Meet-True</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <link rel="stylesheet" href="{{ asset('css/app.css')}}">
    </head>
    <body class="@yield('body-class')" data-module="search @yield('module')">
        @include('svg.all')
        <nav class="nav nav--fixed">
            <div class="nav__content u-clearfix">
                <div class="nav__leftPart u-floatLeft">
                    <a class="siteLogo" href="/">
                      <svg class="svg svg--logo"><use xlink:href="#meet-true" /></svg>
                    </a>
                </div>
                <div class="nav__rightPart u-floatRight">
                    @yield('right-nav')
                </div>
            </div>
        </nav>
        @yield('below-nav')
        <div class="content" id="app">
            <div class="surface">
                @yield('content')
            </div>
        </div>
        <div class="nav__rightPart u-floatRight">
          <span class="btn__search mtSearch">
            <svg class="svg svg--search u-vam"><use xlink:href="#search" /></svg>
            <input type="text" class="input__noStyle mtSearch__input" placeholder="Search Meet-True">
          </span>
          @yield('right-nav')
        </div>
      </div>
    </nav>
    <div class="content" id="app">
      <div class="surface">
        @yield('content')
      </div>
    </div>
    <script src="{{ asset('js/app.js')}}"></script>
  </body>
</html>
