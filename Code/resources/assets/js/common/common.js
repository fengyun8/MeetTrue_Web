import search from './search'

export default class Common {
  constructor (moduleMap) {
    moduleMap.search = new search()
  }
}