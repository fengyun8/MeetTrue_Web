@extends('app')
@section('body-class', 'login')
@section('right-nav')
    <a href="/auth/register" class="u-fontSizeSmaller link link--dark" >注册</a>
@endsection
@section('content')
    @include('auth.figure')
    <div class="u-sizeHalfWidth u-floatRight">
        <form class="form--auth" method="POST" action="/auth/login">
            {!! csrf_field() !!}
            <p class="form__title">
                <span class="u-fontSizeLarge">觅处｜Meet-True</span>
                <span class="u-floatRight u-textColorGray6f">寻找最有价值的自己</span>
            </p>
            <div class="form__field">
                <input class="form__input u-sizeFullWidth" type="text" name="credential" placeholder="输入邮箱/手机号">
            </div>
            <div class="form__field u-positionRelative">
                <input class="form__input u-sizeFullWidth" type="password" name="password" id="password" placeholder="输入密码">
                <svg class="svg svg--switch is-visible"><use y="5" xlink:href="#eye-closed" /></svg>
                <svg class="svg svg--switch"><use xlink:href="#eye-opening" /></svg>
            </div>
            <a href="#" class="u-floatRight u-TextColorGraya7 u-paddingTop10 link">忘记密码?</a>
            <button class="btn btn__auth u-sizeFullWidth" type="submit">登录</button>
            <p class="u-TextColorGraya7 u-floatRight u-paddingTop15">还没有觅处帐号？ <a href="/auth/register" class="u-textColorOrange">立即注册</a></p>
        </form>
    </div>
@endsection
