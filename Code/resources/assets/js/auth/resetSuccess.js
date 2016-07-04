import {buildBasePath} from './../utils'
export default class resetSuccess {
  constructor () {
    this.seconds = 10
    this.loginBtn = '.resetSuccess__countDown'
  }
  init () {
    var element = $(this.loginBtn)
    var timer = setInterval(() => {
    this.seconds--
    if( this.seconds === 0) {
      clearInterval(timer)
      element.text('即将跳转...')
      location.href = buildBasePath('/auth/login')
    } else {
      element.text(this.seconds + 's自动跳至')
    }
  }, 1000)
  }
}