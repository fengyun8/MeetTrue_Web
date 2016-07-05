export default class Login {
  constructor () {
    this.passwordElement = '#password'
    this.switchElement = '.svg--switch'
  }
  init () {
    var switchElement = $(this.switchElement)
    var passwordElement = $(this.passwordElement)
    switchElement.click(e => {
      switchElement.toggleClass('is-visible')
      if(passwordElement.attr('type') === 'password') {
        passwordElement.attr('type', 'text')
      } else {
        passwordElement.attr('type', 'password')
      }
      passwordElement.focus()
    })
  }
}
