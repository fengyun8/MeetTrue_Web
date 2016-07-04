export function countdown(seconds, display) {
  var timer = setInterval(function() {
    seconds--
    if( seconds === 0) {
      clearInterval(timer)
      display.textContent = '获取验证码'
      display.removeAttribute('disabled')
    } else {
      display.textContent = seconds + ' 秒后重新获取'
    }
  }, 1000)
}

export function postSmsCode(mobile) {
  $.ajax({
    type: 'POST',
    url: '/sms/send-code',
    data: { mobile: mobile },
    success: function (response) {
      return response
    }
  })
}

export function checkMobileRegistered(mobile) {
  return $.ajax({
    type: 'POST',
    url: '/verify/phone-unique',
    data: { mobile: mobile }
  })
}

export function validateMobile(mobile) {
  var reg = /^(((13[0-9]{1})|(15[0-9]{1})|(18[0-9]{1}))+\d{8})$/
  return reg.test(mobile)
}