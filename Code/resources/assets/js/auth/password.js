import {buildBasePath,isMobile,isEmail} from './../utils'
import {formPopError,countdown,postSmsCode} from './helper'

var state = {
  mobile:{
    steps: 1,
    change: ".pwd__verifyCodeBox,.pwd__loginBtnBox,.pwd__mobileCodeBox,.pwd__findBtnBox",
    isRight: true
  },
  mobilePwd:{
    step: 1,
  },
  thisType: "mobile"
}

export default class Password {
  constructor () {
    this.state = state

    // 选择模块
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

    // this.checkMobile = () => {
    //   let mobile = $('.pwd__mobile [type="mobile"]')
    //   if(!isMobile(mobile.val())){
    //     mobile.parent().attr('data-error','手机号格式错误')
    //     return state[state.thisType].isRight = false
    //   }
    //   mobile.parent().attr('data-error','')
    //   return state[state.thisType].isRight = true
    // }

    // 验证图片验证码
    this.checkVrCode = () => $.post(buildBasePath('/pic/verify-code'),$('.pwd__mobile #mobile').serialize())

    this.checkVrCodeHandle = data => {
      if(data.status_code == 200){
        formPopError()
        this.stepNext()
      }else{
        formPopError(data.msg)
      }
    }

    // 确认手机验证码
    this.checkMobileVrCode = () => $.post(buildBasePath('/sms/verify-code'),$('.pwd__mobile #mobile').serialize())

    this.checkMobileVrCodeHandle = data => {
      if(data.status_code == 200){
        formPopError()
        $("#mobile,#mobilePwd").toggle()
        this.switchModule('mobilePwd')
        $("#mobilePwd [name='token']").val(data.data.token)
      }else{
        formPopError(data.msg)
      }
    }

    // 手机重置密码确定
    this.resetByMObile = () => $.post(buildBasePath('/password/reset-by-phone'),$('.pwd__mobile #mobilePwd').serialize())

    this.resetByMObileHandle = data => {
      if(data.status_code == 200){
        formPopError()
        location.href = buildBasePath('/password/reset-success')
      }else{
        formPopError(data.msg)
      }
    }

    // 密码找回
    this.postFindEmail = () => $.post(buildBasePath('/password/email'),$('.pwd__email form').serialize())

    this.postFindEmailHandle = data => {
      if(data.status_code == 200){
        formPopError()
        location.href = buildBasePath('/password/send-email-success')
      }else{
        formPopError(data.msg)
      }
    }

    // 短信回调
    this.postSmsCodeHandle = data => {
      formPopError({
        verifyCode: data.msg
      })
    }
  }

  init () {
    // 找回密码方式切换
    $('.pwd__title').click(e => {
      if($(e.target).hasClass('pwd__mobileTitle')){
        this.switchModule('mobile')
      }else if($(e.target).hasClass('pwd__emailTitle')){
        this.switchModule('email')
      }
    })

    // 手机找回密码，步骤控制
    $('#mobile .pwd__btn').click(e => {
      if($(e.target).hasClass('pwd__btn--next')){
        // 下一步
        this.checkVrCode().done(this.checkVrCodeHandle)
      }else if($(e.target).hasClass('pwd__btn--pre')){
        // 上一步
        this.stepPre()
      }else if($(e.target).hasClass('pwd__checkMobileVrCode')){
        // 确认手机验证码
        this.checkMobileVrCode().done(this.checkMobileVrCodeHandle)
      }
    })

    // 更换图片验证码
    $(".pwd__verifyCode").click(e => {
      $(e.target).attr('src',buildBasePath('/pic/create-code') + "?" + Math.random())
    })

    // 发送短信验证码
    $(".pwd__mobileVrCode").click(e => {
      countdown(60,e.target)
      postSmsCode($('[name="mobile"]').val())
        .done(this.postSmsCodeHandle)
    })

    // 手机重置密码确定
    $("#mobilePwd .pwd__btn").click(e => {
      this.resetByMObile().done(this.resetByMObileHandle)
    })

    // 邮箱找回密码事件
    $(".pwd__email .pwd__btn--next").click(e => {
      if(isEmail($(".pwd__email [name='email']").val())){
        this.postFindEmail().done(this.postFindEmailHandle)
      }else{
        formPopError({
          email: "邮箱格式错误"
        })
      }
    })
  }
}