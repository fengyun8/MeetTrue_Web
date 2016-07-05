import {buildBasePath,isEmail,isRightPwd} from './../utils'
import {formPopError,countdown,postSmsCode} from './helper'

export default class ResetByEmail{
  constructor () {
    this.checkForm = () => {
      var errorObj = {}
      if(!isEmail($("[name='email']").val())){
        errorObj.email = "邮箱不合法"
        return errorObj
      }
      if(!isRightPwd($("[name='password']").val())){
        errorObj.password = "请输入6-12位密码"
        return errorObj
      }
      if($("[name='password']").val() != $("[name='password_confirmation']").val()){
        errorObj.password_confirmation = "两次输入密码不一致"
        return errorObj
      }
      return false
    }

    this.resetPwdByEmail = () => $.post(buildBasePath('/password/reset'),$(".pwd__email form").serialize())

    this.resetPwdByEmailHandle = data => {
      if(data.status_code == 200){
        formPopError()
        location.href = buildBasePath('/password/reset-success')
      }else{
        formPopError(data.msg)
      }
    }

    this.resetPwdByEmailErrorHandle = data => {
      formPopError(data.responseJSON)
    }
  }

  init () {
    $(".pwd__email .pwd__btn--full").click(e => {
      var error = this.checkForm()
      console.log(error,!error);
      if(!error){
        this.resetPwdByEmail()
          .done(this.resetPwdByEmailHandle)
          .fail(this.resetPwdByEmailErrorHandle)
      }else{
        formPopError(error)
      }
    })
  }
}