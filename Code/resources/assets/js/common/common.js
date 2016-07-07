import search from './search'
import btnSelect from './btnSelect'

export default class Common {
  constructor (moduleMap) {
    moduleMap.search = new search()
    moduleMap.btnSelect = new btnSelect()
  }
}