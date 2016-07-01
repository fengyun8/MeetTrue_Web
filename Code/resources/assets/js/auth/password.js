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

function init(){
  $('.pwd__title').click(function(){
    if($(this).hasClass('pwd__mobileTitle')){
      switchModule('mobile');
    }else if($(this).hasClass('pwd__emailTitle')){
      switchModule('email');
    }
  });
  $('.pwd__btn').click(function(){
    if($(this).hasClass('pwd__btn--next')){
      stepNext();
    }else{
      stepPre();
    }
  });
}

function switchModule (module) {
  $(".pwd").attr("class",`pwd pwd--${module}`)
  state.thisType = module;
}

function stepNext(){
  let thisType = state[state.thisType];
  if(thisType.steps <2){
    thisType.steps ++;
    changeDomState(thisType)
  }
}

function stepPre(){
  let thisType = state[state.thisType];
  if(thisType.steps >1){
    thisType.steps --;
    changeDomState(thisType)
  }
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
