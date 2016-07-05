@extends('app')
@section('title', '找回密码')
@section('body-class', 'password')
@section('module','resetByEmail')
@section('right-nav')
  <a href="/auth/login" class="u-fontSizeSmaller link link--dark" >登录</a>
  <a href="/auth/register" class="u-fontSizeSmaller link link--dark" >注册</a>
@endsection
@section('content')
  <div class="pwd pwd--email">
    <p class="u-tac">
      <span class="pwd__title pwd__emailTitle">邮箱找回</span>
    </p>
    <div class="pwd__content">
      <div class="pwd__email" >
        <form method="POST" action="/password/reset">
          <input type="hidden" name="token" value="{{ $token }}">
          @if (count($errors) > 0)
            <ul>
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          @endif
          <p class="u-pt35" data-error>
            <input class="input__mt u-sizeFullWidth" type="email" name="email" value="{{ old('email') }}" placeholder="输入账号">
          </p>
          <p class="u-pt35" data-error>
            <input class="input__mt u-sizeFullWidth" type="password" name="password" placeholder="新的密码6-12位">
          </p>
          <p class="u-pt35" data-error>
            <input class="input__mt u-sizeFullWidth" type="password" name="password_confirmation" placeholder="确认密码">
          </p>
          <p class="u-pt40">
            <button type="button" class="pwd__btn--full btn__auth">确定</button>
          </p>
      </form>
      </div>
    </div>
  </div>
@endsection
