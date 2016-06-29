@extends('app')
@section('body-class', 'login')
@section('content')
  @include('auth.figure')
  <div class="u-sizeHalfWidth u-floatRight">
    <form class="form--auth" method="POST" action="/auth/login">
        {!! csrf_field() !!}
        <p class="form__title">
            <svg class="svg svg--logo"><use xlink:href="#meet-true" /></svg>
            <span class="u-floatRight u-textColorGray6f">寻找最有价值的自己</span>
        </p>
        @yield('fields')
        <a href="#" class="u-floatRight u-TextColorGraya7 u-paddingTop10">忘记密码?</a>
        @yield('actions')
    </form>
  </div>
@endsection