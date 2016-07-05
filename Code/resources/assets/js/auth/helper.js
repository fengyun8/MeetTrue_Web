export function countdown(seconds, display) {
  display.setAttribute('disabled', true)
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
  return $.ajax({
    type: 'POST',
    url: '/sms/send-code',
    data: { mobile: mobile }
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
  var reg = /^(((13[0-9]{1})|(15[0-9]{1})|(17[0-9]{1})|(18[0-9]{1}))+\d{8})$/
  return reg.test(mobile)
}

/**
 * 表单错误提示函数
 * @param  {object} errorObj  [包含表单元素name值和表单元素错误文字的一个对象,不带参数为默认清除全部错误信息]
 * 
 * 清除错误 eg:formPopError()
 * 
 * 添加错误 eg:formPopError({
 *   mobile : '手机格式不正确',
 *   pic_code : '验证码错误'
 * })
 * 
 * 函数会从自身开始沿DOM树向上查找存在属性data-error的元素，并添加错误信息
 */
export function formPopError(errorObj) {
  $('[data-error]').attr('data-error','').removeClass('form__error');
  !!errorObj && $.each(errorObj,function(k,v){
    var ele = $(`[name="${k}"]`)
    var errorElement = ele.is("[data-error]")? ele : ele.parents("[data-error]")
    v = typeof(v) == "object" ? v[0] : v
    if(errorElement.length > 0){
      errorElement.attr("data-error",v).addClass('form__error')
    }else{
      console.error(`auth/helper.js formPopError() 找不到name属性为${k}的错误元素`)
    }
  })
}
