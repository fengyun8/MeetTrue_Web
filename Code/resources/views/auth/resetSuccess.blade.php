@extends('app')
@section('title', '找回密码')
@section('body-class', '')
@section('module','resetSuccess')
@section('right-nav')
  <a href="/auth/login" class="u-fontSizeSmaller link link--dark" >登录</a>
  <a href="/auth/register" class="u-fontSizeSmaller link link--dark" >注册</a>
@endsection
@section('content')
  <div class="resetSuccess">
    <div class="resetSuccess__svg">
      <svg class="svg"><use xlink:href="#finsh" /></svg>
    </div>
    <div class="resetSuccess__text">
      <p class="u-fontSizeBase">密码已成功找回，</p>
      <p class="u-fontSizeBase">新密码不要再忘记喽！</p>
      <p class="u-pt15">
        <span class="resetSuccess__countDown">10s自动跳至</span>
        <a class="u-textColorOrange" href="{{ url('auth/login') }}">登录页面</a>
      </p>
    </div>
  </div>
@endsection
