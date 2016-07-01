export default class Login {
  constructor () {
    this.passwordElement = $('#password')
    this.switchElement = $('.svg--switch')
  }
  init () {
    this.switchElement.click(e => {
      this.switchElement.toggleClass('is-visible')
      if(this.passwordElement.attr('type') === 'password') {
        this.passwordElement.attr('type', 'text')
      } else {
        this.passwordElement.attr('type', 'password')
      }
      this.passwordElement.focus()
    })
  }
}
