@extends('app')
@section('content')
    <form class="registerForm" method="POST" action="/auth/register">
        {!! csrf_field() !!}
        <svg class="svg svg__logo"><use xlink:href="#meet-true" /></svg>
        <span>觅处 ｜ Meet True</span>
        <span>寻找最有价值的自己</span>
        <input type="mobile" name="mobile" value="{{ old('email') }}" placeholder="输入手机号">
        <input type="number" name="code" placeholder="输入验证码">
        <input type="password" name="password" id="password" placeholder="输入密码 6～12位">
        <svg class="svg svg__eyeClosed"><use xlink:href="#eye-closed" /></svg>
        <a href="#" class="link__reset-password">忘记密码？</a>
        <button class="btn btn__login btn__full" type="submit">注册</button>
        <p>已有觅处帐号？ <a href="/auth/login" class="link__login">立即登录</a></p>
    </form>
@endsection