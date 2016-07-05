@extends('app')
@section('title', '找回密码')
@section('body-class', '')
@section('module','')
@section('right-nav')
  <a href="/auth/login" class="u-fontSizeSmaller link link--dark" >登录</a>
  <a href="/auth/register" class="u-fontSizeSmaller link link--dark" >注册</a>
@endsection
@section('content')
  <div class="resetSuccess">
    <div class="resetSuccess__svg">
      <svg class="svg"><use xlink:href="#email" /></svg>
    </div>
    <div class="resetSuccess__text">
      <p class="u-fontSizeBase">已发送重置密码链接，</p>
      <p class="u-fontSizeBase">请登录邮箱重置密码！</p>
      <p class="u-pt15">
        请在<span class="u-textColorOrange">30分钟</span>内收信重置密码
      </p>
    </div>
  </div>
@endsection
