<figure class="hero u-sizeFullViewHeight">
  <img class="hero-cover" src="{{ ImageStrategy::process($user->aBanner, 'user_banner') }}" alt="">
  <header class="hero-profile u-flexBetweenNowrap">
    <div class="hero-avatar">
      <img class="avatar avatar--square avatar--110x110" src="{{ ImageStrategy::process($user->aAvatar, 'avatar') }}" alt="Avatar">
    </div>
    <div class="hero-meta">
      <h1 class="hero-title">{{ $user->aNickname }}</h1>
      <p class="hero-focus">
        <span class="hero-college">{{ $user->aSchool }}</span>
        <span class="hero-major">{{ $user->aMajor }}</span>
      </p>
      <span class="buttonSet buttonSet--profile">
        <button class="btn btn--text btn--transparent btn--noPadding btn--textNormal">关注 5</button>
        <button class="btn btn--text btn--transparent btn--noPadding btn--textNormal">粉丝 10</button>
      </span>
    </div>
  </header>
  <p class="hero-description">
    {{ $user->signature }}
  </p>
</figure>