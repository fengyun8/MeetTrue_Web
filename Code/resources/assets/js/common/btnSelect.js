// 下拉选择按钮 btnSelect
export default class btnSelect {
  constructor (){
    this.btnSelectClass = ".btn__select"
  }
  init () {
    window.btnSelectList = {}
    $(this.btnSelectClass).each(function(){
      var name = $(this).children('input[type="hidden"]').attr("name");
      var btnSelect = new btnSelectClass($(this))
      window.btnSelectList[name] = btnSelect
      btnSelect.init()
    })
  }
}

/**
 * 注册的组件放在window.btnSelectList下 取input[type='hidden']的name值为键名
    <span class="btn__select">
      <input type="text" placeholder="专业">
      <input type="hidden" name="qwe">
      <button type="button"></button>
      <ul>
        <li name="caa">123</li>
        <li name="tafa">456</li>
        <li name="xafa">789</li>
      </ul>
    </span>
 *
 * 简写 在实例化的时候会补全，不过这样是没有初始数据的
    <span class="btn__select">
      <input type="text" placeholder="专业">
      <input type="hidden" name="qwe">
    </span>
 * 
 * 导入数据
    window.btnSelectList.qwe.set({
      caa: "中国美术学院",
      tafa: "天津美术学院",
      xafa: "西安美术学院"
    })
 *
 * 获取
    window.btnSelectList.qwe.get()
 *   
 */
class btnSelectClass {
  constructor (element, data = null){
    this.btn__select = element
    this.data = data
    this.preText = ""
    this.set = data => {
      this.data = data
      this.reBuildDom(data)
    }
    this.get = () => this.btn__select.children("input[type='hidden']").val()
  }

  init () {
    var _this = this
    this.data == null && this.buildBtnSelect()
    // 选择 取值
    this.btn__select.on("click","li",function(){
      _this.setValue($(this).attr("name"), $(this).text())
    })
    // 监听输入动作，触发搜索功能
    this.btn__select.children("input[type='text']").keyup(e => {
      var val = $(e.target).val()
      val !== this.preText && this.search(val)
    })
    // 
    // this.btn__select.children("input[type='text'],button").keydown(e => {
    //   ;
    // })
  }

  setValue (name, value) {
    this.btn__select.children("input[type='text']").val(value)
    this.btn__select.children("input[type='hidden']").val(name)
  }

  buildBtnSelect () {
    var ul = this.btn__select.children("ul")
    var button = this.btn__select.children("button")
    button.length == 0 && this.btn__select.children("input[type='hidden']").after('<button type="button"></button>')
    if(ul.length == 0){
      this.btn__select.append("<ul></ul>")
      this.data = {}
    }else{
      var data = {}
      var items = this.btn__select.find("li")
      items.each(function(){
        data[$(this).attr("name")] = $(this).text()
      })
      this.data = data
    }
  }

  reBuildDom (data) {
    var ul = this.btn__select.children("ul")
    ul.empty()
    var items = ""
    $.each(data, function (k,v) {
      items += `<li name="${k}">${v}</li>`
    })
    ul.append(items)
  }

  search (val) {
    this.preText = val
    var data = {}
    if(val != ""){
      $.each(this.data,(k, v) => {
        (v.indexOf(val) > -1) && (data[k] = v)
      })
      this.reBuildDom(data)
    }else{
      this.reBuildDom(this.data)
    }
  }

}