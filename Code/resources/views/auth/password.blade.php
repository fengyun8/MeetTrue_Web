@extends('app')
@section('title', '找回密码')
@section('body-class', 'password')
@section('module','password qwe asd')
@section('right-nav')
  <a href="/auth/login" class="u-fontSizeSmaller link link--dark" >登录</a>
  <a href="/auth/register" class="u-fontSizeSmaller link link--dark" >注册</a>
@endsection
@section('content')
  <div class="pwd pwd--mobile">
    <p class="u-tac">
      <span class="pwd__title pwd__mobileTitle">手机找回</span>
      <span class="pwd__title pwd__emailTitle">邮箱找回</span>
    </p>
    <div class="pwd__content">
      <div class="pwd__mobile">
        <form action="./mobile" method="POST">
          {!! csrf_field() !!}
          <p class="u-pt35 form__error" data-error=''>
            <input type="mobile" name="mobile" class="input u-sizeFullWidth" placeholder="输入手机号">
          </p>
          <p class="pwd__verifyCodeBox u-pt35">
            <input type="text" name="pic_code" class="input u-sizeFullWidth" placeholder="输入验证码">
            <img class="pwd__verifyCode" src="{{ url('pic-code/create')}}" alt="">
          </p>
          <p class="pwd__mobileCodeBox input u-flexBetweenNowrap pwd__formGroup" style="display: none;">
            <input type="text" class="input__noStyle" placeholder="输入手机验证码">
            <button type="button" class="btn__noStyle u-fontSizeSmaller u-TextColorGraya7">已发送验证码 60s</button>
          </p>
          <p class="u-pt40 u-flexBetweenNowrap pwd__loginBtnBox">
            <a href="{{ url('./auth/login') }}" class="pwd__btn link btn__auth btn--gray">返回注册登录</a>
            <button type="button" class="pwd__btn btn__auth pwd__btn--next">下一步</button>
          </p>
          <p class="u-pt40 u-flexBetweenNowrap pwd__findBtnBox" style="display: none;">
            <button type="button" class="pwd__btn btn__auth btn--gray">上一步</button>
            <button type="submit" class="pwd__btn btn__auth pwd__btn--next">下一步</button>
          </p>
        </form>
      </div>
      <div class="pwd__email" >
        <form method="POST" action="/password/email">
          {!! csrf_field() !!}
          @if (count($errors) > 0)
            <ul>
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          @endif
          <p class="u-pt35">
            <input type="email" name="email" class="input u-sizeFullWidth" value="{{ old('email') }}" placeholder="输入邮箱">
          </p>
          <p class="u-pt40 u-flexBetweenNowrap">
            <a href="{{ url('./auth/login') }}" class="pwd__btn link btn__auth btn--gray">返回注册登录</a>
            <button type="button" type="submit" class="pwd__btn btn__auth">下一步</button>
          </p>
      </form>
      </div>
    </div>
  </div>
@endsection
