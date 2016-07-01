@extends('app')

@section('title')
  抱歉
@endsection

@section('content')
  <style>
  .error-card {
    width: 500px;
    background-color: white;
    margin: 50px auto;
    padding: 30px;
    border-radius: 3px;
    color: #424242;
    box-shadow: 0 2px 4px #ccc;
  }
  .error-card-heading {
    margin-bottom: 14px;
  }
  .card-btn {
    display: block;
    background-color: #F96350;
    color: white;
    float: right;
    height: 30px;
    line-height: 30px;
    padding: 0 24px;
    font-size: 14px;
    border-radius: 2px;
  }
  .clear {
    clear: both;
  }
  </style>

  <div class="error-card">
    <div class="error-card-heading">
      <h3><i class="fa fa-chain-broken"></i> 抱歉</h3>
    </div>
    <p class="error-caption">你访问的页面不存在，你希望返回吗？</p>
    <div>
      <img src="{{ url('img/404-01.jpg') }}" width="100%" alt="">
    </div>

    <a class="card-btn" href="#" onclick="window.history.back();"><i class="fa fa-arrow-left"></i> 返回</a>
    <div class="clear"></div>
  </div>
@endsection
