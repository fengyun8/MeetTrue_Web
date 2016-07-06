<nav class="nav nav--fixed">
    <div class="nav__content u-clearfix">
        <div class="nav__leftPart u-floatLeft">
            <a class="siteLogo" href="/">
              <svg class="svg svg--logo"><use xlink:href="#meet-true" /></svg>
            </a>
        </div>
        <div class="nav__rightPart u-floatRight">
            <span class="btn__search mtSearch">
                <svg class="svg svg--search u-vam"><use xlink:href="#search" /></svg>
                <input type="text" class="input__noStyle mtSearch__input" placeholder="Search Meet-True">
            </span>
            @if (Auth::check())
                <a href='#'>{{ Auth::user()->nickname}}</a>
            @else
                @if (Request::is('/auth/login'))
                    <a href="/auth/register" class="u-fontSizeSmaller link link--dark" >注册</a>
                @else
                    <a href="/auth/login" class="u-fontSizeSmaller link link--dark" >登录 ｜ </a>
                @endif           
                @if (Request::is('/auth/register'))
                    <a href="/auth/login" class="u-fontSizeSmaller link link--dark" >登录</a>
                @else
                    <a href="/auth/register" class="u-fontSizeSmaller link link--dark" > 注册</a>
                @endif
            @endif
        </div>
    </div>
</nav>