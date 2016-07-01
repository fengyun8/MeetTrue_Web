import {countdown, postSmsCode} from './helper'
export default class Register {
  constructor () {
    this.mobile = $('#mobile').val().trim()
    this.SmsButton = $('.btn--smsCode')
  }
  init () {
    this.SmsButton.click(e => {
      countdown(10, e.target)
      e.target.setAttribute('disabled', true)
      if (this.mobile.length) {
        postSmsCode(this.mobile)
      }
    })
  }
}
