import search from './search'
// import btnSelect from './btnSelect'

export default class Module {
  constructor (moduleMap) {
    moduleMap.search = new search()
    // moduleMap.btnSelect = new btnSelect()
  }
}