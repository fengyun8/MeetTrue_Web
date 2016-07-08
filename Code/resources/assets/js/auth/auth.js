import Password from './password'
import Login from './login'
import Register from './register'
import ResetSuccess from './resetSuccess'
import ResetByEmail from './resetByEmail'

export default class Auth {
  constructor (moduleMap) {
    moduleMap.password = new Password()
    moduleMap.login = new Login()
    moduleMap.register = new Register()
    moduleMap.resetSuccess = new ResetSuccess()
    moduleMap.resetByEmail = new ResetByEmail()
  }
}

// {
//   1:{
//     "1": "芜湖"
//   },
//   2:{
//     "1": "芜湖"
//   }
// }

// {
//   "1": "武汉",
//   "2": "安徽"
// }