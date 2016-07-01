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
  console.log(mobile)
}