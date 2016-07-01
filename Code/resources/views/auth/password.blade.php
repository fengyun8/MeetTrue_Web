@extends('app')
@section('title', '找回密码')
@section('body-class', 'password')
@section('right-nav')
  <a href="/auth/login" class="u-fontSizeSmaller link link--dark" >登录</a>
  <a href="/auth/register" class="u-fontSizeSmaller link link--dark" >注册</a>
@endsection
@section('content')
  <div class="pwd">
    <p class="u-tac">
      <span class="pwd__title pwd__title--active">手机找回</span>
      <span class="pwd__title">邮箱找回</span>
    </p>
    <div class="pwd__content">
      <div class="pwd__mobile">
        <form action="./mobile" method="POST">
          {!! csrf_field() !!}
          <p class="u-pt35">
            <input type="mobile" class="input u-sizeFullWidth" placeholder="输入手机号">
          </p>
          <p class="pwd__verifyCodeBox u-pt35">
            <input type="text" class="input u-sizeFullWidth" placeholder="输入验证码">
            <img class="pwd__verifyCode" src="http://images.meet-true.com/default/201605/kunjugn1pxvc9aqt.jpg@980w_456h" alt="">
          </p>
          <p class="u-pt40 u-flexBetweenNowrap">
            <button class="pwd__btn btn__auth btn--gray">返回注册登录</button>
            <button class="pwd__btn btn__auth">下一步</button>
          </p>
        </form>
      </div>
    </div>
  </div>
  <form method="POST" action="/password/email">
    {!! csrf_field() !!}

    @if (count($errors) > 0)
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <div>
        Email
        <input type="email" name="email" value="{{ old('email') }}">
    </div>

    <div>
        <button type="submit">
            发送重置密码邮件
        </button>
    </div>
</form>
@endsection
