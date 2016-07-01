import $ from 'jquery'
import password from './auth/password'
window.$ = $;

var moduleMap = {};
moduleMap.password = new password();

/**
 * 模块启动方法
 *
 * 模块于上方import进来
 * 实例化（new）后放到moduleMap里
 *
 * 页面加载完成后会获取body标签里data-module里的数据逐个执行相应模块的init方法。
 */
$(function () {
  var moduleNameList = $('body').data('module').split(' ');
  moduleNameList.forEach(function(moduleName){
    !!moduleMap[moduleName] && moduleMap[moduleName].init();
  })
  
})


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
