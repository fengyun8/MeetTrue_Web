var state = {
  mobile:{
    steps: 1,
    max: 3,
    change: ".pwd__verifyCodeBox,.pwd__loginBtnBox,.pwd__mobileCodeBox,.pwd__findBtnBox"
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
        this.stepNext()
      }else{
        this.stepPre()
      }
    })
  }
<<<<<<< 31ede8867a03e52c7bed7a51bc8e0bc6cf4b7c4f
}
<<<<<<< 5bb0c03501bbb18992f79931e2771bd8c628b69d
=======

function changeDomState(thisType){
  $(thisType.change).toggle();
}

export default init;

// class Password {
//   constructor () {
//     this.name = 'mobile';
//   }
//   init () {
//     $('.pwd__title').click(function(){
//       switchModule(123)

//       // if($(this).hasClass('pwd__mobileTitle')){

//       // }else if($(this).hasClass('pwd__mobileTitle'))
//     })
//   }
//   switchModule (module) {
//     console.log(module);
//   }
// } 
>>>>>>> 找回密码，交互ing
=======
}
>>>>>>> 找回密码2
