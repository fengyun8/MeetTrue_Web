@extends('app')
@section('below-nav')
  @include('users.hero')
  <div class="u-maxWidth650 u-positionRelative u-marginTopNegative92 u-pv20 container">
    @include('users.tabs')
  </div>
@endsection
@section('content')
  @include('users.profile')
@endsection
