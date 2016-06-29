@extends('auth.layout')
@section('fields')
    <div class="form__field">
        <input class="form__input u-sizeFullWidth" type="text" name="email" value="{{ old('email') }}" placeholder="输入邮箱/手机号">
    </div>
    <div class="form__field form__field--withSwitch">
        <input class="form__input u-sizeFullWidth" type="password" name="password" id="password" placeholder="输入密码">
        <svg class="svg svg--eyeClosed is-active"><use xlink:href="#eye-closed" /></svg>
        <svg class="svg svg--eyeOpen"><use xlink:href="#eye-open" /></svg>
    </div>
@endsection
@section('actions')
    <button class="btn btn--auth u-sizeFullWidth" type="submit">登录</button>
    <p class="u-TextColorGraya7 u-floatRight u-paddingTop15">还没有觅处帐号？ <a href="/auth/register" class="u-textColorOrange">立即注册</a></p>
@endsection
