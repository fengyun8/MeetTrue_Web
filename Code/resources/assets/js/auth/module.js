import Password from './password'
import Login from './login'
import Register from './register'
import ResetSuccess from './resetSuccess'
import ResetByEmail from './resetByEmail'

export default class Module {
  constructor (moduleMap) {
    moduleMap.password = new Password()
    moduleMap.login = new Login()
    moduleMap.register = new Register()
    moduleMap.resetSuccess = new ResetSuccess()
    moduleMap.resetByEmail = new ResetByEmail()
  }
}