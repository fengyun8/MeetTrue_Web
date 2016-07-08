<div class="layoutSingleColumn">
  <div class="heading--page">完善个人资料，申请认证工作室</div>
  <div class="heading u-clearfix heading--borderedTop heading--section">
    <div class="u-clearfix">
      <div class="heading-content u-floatLeft">
        <span class="heading-title">个人资料</span>
      </div>
    </div>
  </div>
  <div class="row form-row">
    <div class="col form-heading u-size3of12">
      昵称
    </div>
    <div class="col form-contents u-size9of12">
      <input class="form-input form-input--borderTransparent" value="mt_439204384"></input>
      <span class="btn btn--edit btn--withSvg">
        @include('svg.edit')
      </span>
      <div class="form-hint"></div>
    </div>
  </div>
  <div class="row form-row">
    <div class="col form-heading u-size3of12">
      头像
      <span class="form-asterisk">*</span>
    </div>
    <div class="col form-contents u-size9of12">
      <div class="avatar avatar--square avatar--110x110">
        <img class="avatar-image" src="{{ ImageStrategy::process($user->aAvatar, 'avatar') }}" alt="Avatar">
        <span class="avatar-overlay"></span>
        @include('svg.edit')
      </div>
      <div class="form-hint"></div>
    </div>
  </div>
  <div class="row form-row">
    <div class="col form-heading u-size3of12">
      专业
      <span class="form-asterisk">*</span>
    </div>
    <div class="col form-contents u-size9of12">
      <span class="btn__select">
        <input type="text" value="123" placeholder="专业">
        <input type="hidden" name="qwe">
        <button type="button"></button>
        <ul>
          <li>123</li>
          <li>456</li>
          <li>789</li>
        </ul>
      </span>
      <div class="form-hint"></div>
    </div>
  </div>
  <div class="row form-row">
    <div class="col form-heading u-size3of12">
      院校
      <span class="form-asterisk">*</span>
    </div>
    <div class="col form-contents u-size9of12">
      <span class="btn__select">
        <input type="text" value="123" placeholder="专业">
        <button type="button"></button>
        <ul>
          <li>123</li>
          <li>456</li>
          <li>789</li>
        </ul>
      </span>
      <div class="form-hint"></div>
    </div>
  </div>
  <div class="row form-row">
    <div class="col form-heading u-size3of12">
      城市
    </div>
    <div class="col form-contents u-size9of12">
      <span class="btn__select">
        <input type="text" placeholder="省">
        <input type="hidden" name="province">
      </span>
      <span class="btn__select">
        <input type="text" placeholder="市">
        <input type="hidden" name="city">
      </span>
      <div class="form-hint"></div>
    </div>
  </div>
  <div class="row form-row">
    <div class="col form-heading u-size3of12">
      性别
    </div>
    <div class="col form-contents u-size9of12">
      <div class="form-hint"></div>
      <label>男</label>
      <input type="radio"></input>
      <label>女</label>
      <input type="radio" name="女"></input>
    </div>
  </div>
  <div class="row form-row">
    <div class="col form-heading u-size3of12">
      签名
    </div>
    <div class="col form-contents u-size9of12">
      <input class="form-input" type="text"></input>
      <div class="form-hint"></div>
    </div>
  </div>
  <div class="row form-row">
    <div class="col form-heading u-size3of12">
      个性域名
    </div>
    <div class="col form-contents u-size9of12">
      <input class="form-input" value="mt_1990"></input>
      <div class="form-hint">
        www.meet-true/users/mt_1990
      </div>
    </div>
  </div>
  <div class="heading u-clearfix heading--borderedTop heading--section">
    <div class="u-clearfix">
      <div class="heading-content u-floatLeft">
        <span class="heading-title">账号设置</span>
      </div>
    </div>
  </div>
  <div class="row form-row">
    <div class="col form-heading u-size3of12">
      手机
    </div>
    <div class="col form-contents u-size9of12">
      <div class="editable editorWithUnderline">18670702894</div>
    </div>
  </div>
  <div class="row form-row">
    <div class="col form-heading u-size3of12">
      邮箱
    </div>
    <div class="col form-contents u-size9of12">
      <a class="link link--orange" href="#">立即绑定</a>
      <div class="form-hint"></div>
    </div>
  </div>
  <div class="row form-row">
    <div class="col form-heading u-size3of12">
      密码
    </div>
    <div class="col form-contents u-size9of12">
      <a class="link link--orange" href="#">修改密码</a>
      <div class="form-hint"></div>
    </div>
  </div>
  <div class="row form-row">
    <div class="col form-heading u-size3of12">
      微信
    </div>
    <div class="col form-contents u-size9of12">
      <a class="link link--orange" href="#">立即绑定</a>
      <div class="form-hint"></div>
    </div>
  </div>
  <div class="heading u-clearfix heading--borderedTop heading--section">
    <div class="u-clearfix">
      <div class="heading-content u-floatLeft">
        <span class="heading-title">工作室认证</span>
        <span class="heading--withSvgSet svgSet">
          @include('svg.umbrella')
          @include('svg.waterline')
          @include('svg.money-bag')
          @include('svg.certificate')
        </span>
        <p class="heading-description">认证后可获得专利保护、生产孵化、预售交易 copy</p>
      </div>
    </div>
  </div>
  <div class="row form-row">
    <div class="col form-heading u-size3of12">
      真实姓名
    </div>
    <div class="col form-contents u-size9of12">
      <input class="form-input" type="text"></input>
      <div class="form-hint"></div>
    </div>
  </div>
  <div class="row form-row">
    <div class="col form-heading u-size3of12">
      作品证明
    </div>
    <div class="col form-contents u-size9of12">
      <span class="btn btn--upload btn--large btn--withSvg">
        @include('svg.upload')
        上传
      </span>
      <span class="btn btn--upload btn--large btn--withSvg">
        @include('svg.upload')
        上传
      </span>
      <div class="form-hint">原创作品，或者本人在工作室的工作照片2张</div>
    </div>
  </div>
  <div class="row form-row">
    <div class="col form-heading u-size3of12">
      材料证明
    </div>
    <div class="col form-contents u-size9of12">
      <span class="btn btn--upload btn--large btn--withSvg">
        @include('svg.upload')
        上传
      </span>
      <div class="form-hint">请上传个人身份证正面照片一张</div>
    </div>
  </div>
</div>
