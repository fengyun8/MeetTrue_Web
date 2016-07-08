import Profile from './profile'
export default class Module {
  constructor (moduleMap) {
    moduleMap.profile = new Profile()
  }
}