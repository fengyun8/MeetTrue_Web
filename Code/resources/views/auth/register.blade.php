@extends('auth.layout')
@section('fields')
   <div class="form__field">
        <input class="form__input u-sizeFullWidth" type="text" name="mobile" value="{{ old('email') }}" placeholder="输入手机号">
    </div>
    <div class="form__field">
        <input class="form__input u-sizeFullWidth" type="text" name="code" placeholder="输入验证码">
    </div>
    <div class="form__field form__field--withSwitch">
        <input class="form__input u-sizeFullWidth" type="password" name="password" id="password" placeholder="输入密码">
        <svg class="svg svg--eyeClosed is-active"><use xlink:href="#eye-closed" /></svg>
        <svg class="svg svg--eyeOpen"><use xlink:href="#eye-open" /></svg>
    </div>
@endsection
@section('actions')
    <button class="btn btn--auth u-sizeFullWidth" type="submit">立即注册</button>
    <p class="u-TextColorGraya7 u-floatRight u-paddingTop15">已有觅处帐号？ <a href="/auth/login" class="u-textColorOrange">立即登录</a></p>
@endsection