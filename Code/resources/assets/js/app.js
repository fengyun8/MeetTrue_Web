import $ from 'jquery'

$(function() {
  $('.svg--switch').click(e => {
    $('.svg--switch').toggleClass('is-visible')
    var $password = $('#password')
    if($password.attr('type') === 'password') {
      $password.attr('type', 'text')
    } else {
      $password.attr('type', 'password')
    }
    $password.focus()
  })

  $('.btn--smsCode').click(e => {
    countdown(10, e.target)
    e.target.setAttribute('disabled', true)
  })

  function countdown(seconds, display) {
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
})