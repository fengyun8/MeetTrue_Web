import {buildBasePath,isMobile} from './../utils'

var state = {
  mobile:{
    steps: 1,
    max: 3,
    change: ".pwd__verifyCodeBox,.pwd__loginBtnBox,.pwd__mobileCodeBox,.pwd__findBtnBox",
    isRight: true
  },
  email:{
    steps: 1,
    max:2
  },
  thisType: "mobile"
}

export default class Password {
  constructor () {
    this.state = state
    this.switchModule = module => {
      $(".pwd").attr("class",`pwd pwd--${module}`)
      state.thisType = module
    }
    this.stepNext = () => {
      if(state[state.thisType].steps <2){
        state[state.thisType].steps ++
        $(state[state.thisType].change).toggle()
      }
    }
    this.stepPre = () => {
      if(state[state.thisType].steps >1){
        state[state.thisType].steps --
        $(state[state.thisType].change).toggle()
      }
    }
    this.checkMobile = () => {
      let mobile = $('.pwd__mobile [type="mobile"]');
      if(!isMobile(mobile.val())){
        mobile.parent().attr('data-error','手机号格式错误');
        return state[state.thisType].isRight = false;
      }
      mobile.parent().attr('data-error','');
      return state[state.thisType].isRight = true;
    }
    this.checkVrCode = () => {
      $.post(buildBasePath('/pic-code/verify'),$('.pwd__mobile form').serialize())
        .done(data => {
          console.log('test');
        });
    }
  }
  init () {
    $('.pwd__title').click(e => {
      if($(e.target).hasClass('pwd__mobileTitle')){
        this.switchModule('mobile')
      }else if($(e.target).hasClass('pwd__emailTitle')){
        this.switchModule('email')
      }
    })
    $('.pwd__btn').click(e => {
      if($(e.target).hasClass('pwd__btn--next')){
        // this.checkMobile() && this.stepNext();
        this.checkVrCode()
      }else{
        this.stepPre()
      }
    })
    $(".pwd__verifyCode").click(e => {
      $(e.target).attr('src',buildBasePath('/pic-code/create') + "?" + Math.random());
    })
  }
}
