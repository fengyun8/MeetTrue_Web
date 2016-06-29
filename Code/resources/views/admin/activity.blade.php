@extends('admin')
@section('content')
  <div class="pageContent">
    <p class="toolBar">
      <span class="toolBar__title">活动</span>
      <button class="toolBar__btn btn__noStyle">添加活动</button>
    </p>
    <div class="operatingFloor">
      <p class="operatingFloor__titleBar">
        <span class="operatingFloor__title">banner</span>
        <span class="operatingFloor__title">链接</span>
        <span class="operatingFloor__title">操作</span>
      </p>
      <p class="operatingFloor__itemBar">
        <span class="operatingFloor__item">
          <img src="http://images.meet-true.com/default/201605/kunjugn1pxvc9aqt.jpg@980w_456h" alt="">
        </span>
        <span class="operatingFloor__item">
          <input class="input" type="text" placeholder="输入链接地址">
        </span>
        <span class="operatingFloor__item">
          <button class="operatingFloor__btn btn__noStyle">删除此项</button>
        </span>
      </p>
    </div>
  </div>
@endsection
