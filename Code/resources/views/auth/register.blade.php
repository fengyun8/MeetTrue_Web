@extends('app')
@section('body-class', 'register')
@section('right-nav')
    <a href="/auth/login" class="u-fontSizeSmaller link link--dark" >登录</a>
@endsection
@section('content')
    @include('auth.figure')
    <div class="u-sizeHalfWidth u-floatRight">
        <form class="form--auth" method="POST" action="/auth/register">
            {!! csrf_field() !!}
            <p class="form__title">
                <span class="u-fontSizeLarge">觅处｜Meet-True</span>
                <span class="u-floatRight u-textColorGray6f">寻找最有价值的自己</span>
            </p>
            @yield('fields')
            <div class="form__field">
                <input class="form__input u-sizeFullWidth" type="text" name="mobile" value="{{ old('email') }}" placeholder="输入手机号">
            </div>
            <div class="form__field u-positionRelative">
                <input class="form__input u-sizeFullWidth" type="text" name="code" placeholder="输入验证码">
                <button class="btn btn--link btn--smsCode u-textColorOrange u-positionAbsolute">获取验证码</button>
            </div>
            <div class="form__field u-positionRelative">
                <input class="form__input u-sizeFullWidth" type="password" name="password" id="password" placeholder="输入密码">
                <svg class="svg svg--eyeClosed is-active"><use xlink:href="#eye-closed" /></svg>
                <svg class="svg svg--eyeOpening"><use xlink:href="#eye-opening" /></svg>
            </div>
            <a href="#" class="u-floatRight u-TextColorGraya7 u-paddingTop10">忘记密码?</a>
            <button class="btn btn--auth u-sizeFullWidth" type="submit">立即注册</button>
            <p class="u-TextColorGraya7 u-floatRight u-paddingTop15">已有觅处帐号？ <a href="/auth/login" class="u-textColorOrange">立即登录</a></p>
        </form>
    </div>
@endsection
