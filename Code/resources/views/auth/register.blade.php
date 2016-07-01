@extends('app')
@section('body-class', 'register')
@section('module', 'register')
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
            @if ($errors->has('mobile'))
                <div class="form__field form__error" data-error="{{ $errors->first('mobile')}}">
            @else
                <div class="form__field">
            @endif
                <input class="input u-sizeFullWidth" type="text" id="mobile" name="mobile" value="{{ old('mobile') }}" placeholder="输入手机号">
            </div>
            @if ($errors->has('verifyCode'))
                <div class="form__field u-positionRelative form__error" data-error="{{ $errors->first('mobile')}}">
            @else
                <div class="form__field u-positionRelative">
            @endif
                <input class="form__input u-sizeFullWidth" type="text" name="verifyCode" placeholder="输入验证码">
                <button type="button" class="btn btn--link btn--smsCode u-textColorOrange u-positionAbsolute">获取验证码</button>
            </div>
            <div class="form__field u-positionRelative">
                <input class="form__input u-sizeFullWidth" type="password" name="password" id="password" placeholder="输入密码">
                <svg class="svg svg--switch is-visible"><use y="5" xlink:href="#eye-closed" /></svg>
                <svg class="svg svg--switch"><use xlink:href="#eye-opening" /></svg>
            </div>
            <a href="#" class="u-floatRight u-TextColorGraya7 u-pt10 link">忘记密码?</a>
            <button class="btn btn__auth u-sizeFullWidth" type="submit">立即注册</button>
            <p class="u-TextColorGraya7 u-floatRight u-pt15">已有觅处帐号？ <a href="/auth/login" class="link u-textColorOrange">立即登录</a></p>
        </form>
    </div>
@endsection
