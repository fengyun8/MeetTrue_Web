@extends('app')
@section('content')
    <form class="loginForm" method="POST" action="/auth/login">
        {!! csrf_field() !!}
        <svg class="svg svg__logo"><use xlink:href="#meet-true" /></svg>
        <span>觅处 ｜ Meet True</span>
        <span>寻找最有价值的自己</span>
        <input type="email" name="email" value="{{ old('email') }}" placeholder="输入邮箱/手机号">
        <input type="password" name="password" id="password" placeholder="输入密码">
        <svg class="svg svg__eyeClosed"><use xlink:href="#eye-closed" /></svg>
        <a href="#" class="link__reset-password">忘记密码？</a>
        <button class="btn btn__login btn__full" type="submit">登录</button>
        <p>还没有觅处帐号？ <a href="/auth/register" class="link__register">立即注册</a></p>
    </form>
@endsection
