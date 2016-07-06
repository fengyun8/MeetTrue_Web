@extends('app')
@section('title', '找回密码')
@section('body-class', 'password')
@section('module','password')
@section('content')
  <div class="pwd pwd--mobile">
    <p class="u-tac">
      <span class="pwd__title pwd__mobileTitle">手机找回</span>
      <span class="pwd__title pwd__emailTitle">邮箱找回</span>
    </p>
    <div class="pwd__content">
      <div class="pwd__mobile">
        <form action="./pic/verify-code" id="mobile" method="POST">
          {!! csrf_field() !!}
          <p class="u-pt35" data-error>
            <input type="mobile" name="mobile" class="input__mt u-sizeFullWidth" placeholder="输入手机号">
          </p>
          <p class="pwd__verifyCodeBox u-pt35" data-error>
            <input type="text" name="pic_code" class="input__mt u-sizeFullWidth" placeholder="输入验证码">
            <img class="pwd__verifyCode" src="{{ url('pic/create-code')}}" alt="">
          </p>
          <p class="pwd__mobileCodeBox input__mt u-flexBetweenNowrap pwd__formGroup" data-error style="display: none;">
            <input type="text" class="input__noStyle" name="verifyCode" placeholder="输入手机验证码">
            <button type="button" class="pwd__mobileVrCode btn__noStyle u-fontSizeSmaller u-textColorOrange">获取验证码</button>
            <input type="hidden" name="interval" value="60">
          </p>
          <p class="u-pt40 u-flexBetweenNowrap pwd__loginBtnBox">
            <a href="{{ url('./auth/login') }}" class="pwd__btn link btn__auth btn--gray">返回注册登录</a>
            <button type="button" class="pwd__btn btn__auth pwd__btn--next">下一步</button>
          </p>
          <p class="u-pt40 u-flexBetweenNowrap pwd__findBtnBox" style="display: none;">
            <button type="button" class="pwd__btn btn__auth btn--gray pwd__btn--pre">上一步</button>
            <button type="button" class="pwd__btn btn__auth pwd__checkMobileVrCode">下一步</button>
          </p>
        </form>
        <form action="./reset-by-phone" id="mobilePwd" method="POST" style="display: none;">
          {!! csrf_field() !!}
          <p class="u-pt35" data-error>
            <input type="hidden" name="token">
            <input type="password" class="input__mt u-sizeFullWidth" name="password" placeholder="新的密码 6-12位">
          </p>
          <p class="u-pt35" data-error>
            <input type="password" class="input__mt u-sizeFullWidth" name="password_confirmation" placeholder="确认密码">
          </p>
          <p class="u-pt40 u-flexBetweenNowrap">
            <button type="button" class="pwd__btn btn__auth">确定</button>
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
          <p class="u-pt35" data-error>
            <input type="email" name="email" class="input__mt u-sizeFullWidth" value="{{ old('email') }}" placeholder="输入邮箱">
          </p>
          <p class="u-pt40 u-flexBetweenNowrap">
            <a href="{{ url('./auth/login') }}" class="pwd__btn link btn__auth btn--gray">返回注册登录</a>
            <button type="button" type="submit" class="pwd__btn btn__auth pwd__btn--next">下一步</button>
          </p>
      </form>
      </div>
    </div>
  </div>
@endsection
