@extends('app')
@section('right-nav')
  @if (Auth::check())
    <a href='#'>{{ Auth::user()->nickname}}</a>
  @else
    <a href="/auth/login" class="u-fontSizeSmaller link link--dark" >登录 | </a>
    <a href="/auth/register" class="u-fontSizeSmaller link link--dark" > 注册</a>
  @endif
@endsection
@section('content')
@endsection
