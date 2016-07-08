<div class="gDetail">
  <p class="gDetail__header u-alignMiddle">
    <span class="gDetail__headerImg u-alignBlock" style="background-image: url('http://images.meet-true.com/default/201604/dwsxpwp7ucagzoej.jpg@150w_80Q')" title="{{ Auth::user()->nickname}}">
    </span>
    <span class="u-alignBlock">
      <span class="gDetail__name">{{ Auth::user()->nickname}}</span>
      <span class="gDetail__major">游戏动画</span>
    </span>
    <span class="u-alifnBlock">
      <!-- <button class="btn btn__follow btn__follow--followed"></button> -->
      <button class="btn btn__follow"></button>
    </span>
  </p>
  <div class="gDetail__content"></div>
  <p class="gDetail__other">
    <span class="gDetail__type"></span>
    <span class="gDetail__share"></span>
  </p>
  <p class="gDetail__like">
    <!-- <button class="btn btn__like btn__like--active" data-num="123"></button> -->
    <button class="btn btn__like" data-num="123"></button>
  </p>
  <div class="gDetail__userInfo"></div>
  <div class="gDetail__comment"></div>
</div>