import {countdown, postSmsCode, checkMobileRegistered, validateMobile} from './helper'
export default class Register {
  init () {
    $('.btn__smsCode').click(e => {
      var mobileElement = $('#mobile')
      var mobile = mobileElement.val()
      var mobileField = mobileElement.parent()
      if(mobile && !mobileField.hasClass('form__error')) {
        countdown(10, e.target)
      }
      var mobile = $('#mobile').val().trim()
      if (mobile.length && !mobileField.hasClass('form__error')) {
        postSmsCode(mobile)
      }
    })

    $('#mobile').change(e => {
      var mobile = e.target.value
      var errorBox = e.target.parentElement
      if (mobile.length === 0 || mobile.length !== 11 || !validateMobile(mobile)) {
        errorBox.removeAttribute('data-error')
        errorBox.classList.add('form__error')
        e.target.classList.add('input--invalid')
        errorBox.setAttribute('data-error', '请输入有效的手机号码')
      } else {
        errorBox.removeAttribute('data-error')
        errorBox.classList.remove('form__error')
        var promise = checkMobileRegistered(mobile)
        e.target.classList.remove('input--invalid')
        promise.then(data => {
          if(data.status_code === 422) {
            errorBox.classList.add('form__error')
            $('#mobile').parent().attr('data-error', data.msg)
          }
        })
      }
    })

    var passwordElement = $('#password')
    $('.svg--switch').click(function(){
      $('.svg--switch').toggleClass('is-visible')
      if(passwordElement.attr('type') === 'password') {
        passwordElement.attr('type', 'text')
      } else {
        passwordElement.attr('type', 'password')
      }
      passwordElement.focus()
    })
  }
}
