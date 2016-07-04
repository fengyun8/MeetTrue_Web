import {countdown, postSmsCode, checkMobileRegistered, validateMobile} from './helper'
export default class Register {
  init () {
    $('.btn--smsCode').click(e => {
      countdown(10, e.target)
      e.target.setAttribute('disabled', true)
      var mobile = $('#mobile').val().trim()
      if (mobile.length) {
        postSmsCode(mobile)
      }
    })
    $('#mobile').change(e => {
      var mobile = e.target.value
      var errorBox = e.target.parentElement
      if (mobile.length === 0 || mobile.length !== 11 || !validateMobile(mobile)) {
        errorBox.removeAttribute('data-error')
        errorBox.setAttribute('data-error', '请输入有效的手机号码')
      } else {
        errorBox.removeAttribute('data-error')
        var promise = checkMobileRegistered(mobile)
        promise.then(data => {
          if(data.status_code === 422) {
            $('#mobile').parent().attr('data-error', data.msg)
          }
        })
      }
    })
  }
}
