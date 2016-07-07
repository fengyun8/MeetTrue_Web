<!-- nav--white -->
<nav class="nav nav--fixed">
  <div class="nav__content u-clearfix">
    <div class="nav__leftPart u-floatLeft">
      <a class="siteLogo link" href="/">
        <svg class="svg svg--logo nav__logo--colour"><use xlink:href="#meet-true" /></svg>
        <svg class="svg svg--logo nav__logo--white"><use xlink:href="#meet-true--white" /></svg>
      </a>
    </div>
    <div class="nav__menu u-floatLeft">
      <a href="#" class="u-fontSizeSmall link nav__item">专题</a>
      <a href="#" class="u-fontSizeSmall link nav__item">发现</a>
    </div>
    <div class="nav__rightPart u-floatRight">
      <span class="btn__search mtSearch link u-hideUnderSmall nav__item">
        <svg class="svg svg--search nav__logo--colour"><use xlink:href="#search" /></svg>
        <svg class="svg svg--search nav__logo--white"><use xlink:href="#search--white" /></svg>
        <input type="text" class="input__noStyle mtSearch__input" placeholder="Search Meet-True">
      </span>
      @if (Auth::check())
        @if (Auth::user()->group > 0)
          <a href="#" class="nav__upload u-fontSizeSmaller link nav__item">
            <svg class="svg svg__upload nav__logo--colour"><use xlink:href="#upLoad" /></svg>
            <svg class="svg svg__upload nav__logo--white"><use xlink:href="#upLoad--white" /></svg>
            发作品
          </a>
          <a href='#' class="u-fontSizeSmaller link nav__headerImg nav__headerImg--auth nav__item" title="{{ Auth::user()->nickname}}" style="background-image: url('http://images.meet-true.com/default/201604/dwsxpwp7ucagzoej.jpg@150w_80Q')"></a>
        @else
          <a href="#" class="nav__upload u-fontSizeSmaller link nav__item">
            <i class="nav__authIcon"></i>
            <span class="u-textColorOrange">认证</span>
          </a>
          <a href='#' class="u-fontSizeSmaller link nav__headerImg  nav__item" title="{{ Auth::user()->nickname}}" style="background-image: url('http://images.meet-true.com/default/201604/dwsxpwp7ucagzoej.jpg@150w_80Q')"></a>
        @endif
      @else
        <span class="nav__item nav__loginBox">
          <a href="/auth/login" class="u-fontSizeSmaller link" >登录</a>
          <a href="/auth/register" class="u-fontSizeSmaller link" >注册</a>
        </span>
      @endif
    </div>
  </div>
</nav>