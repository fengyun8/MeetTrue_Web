import {countdown, postSmsCode} from './helper'
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
  }
}
