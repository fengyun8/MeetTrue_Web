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
      this.buildDom(data)
    }
    this.get = () => this.btn__select.children("input[type='hidden']").val()
  }

  init () {
    var _this = this
    this.data == null && this.buildData()
    this.btn__select.on("click","li",function(){
      _this.setValue($(this).attr("name"), $(this).text())
    })
    this.btn__select.children("input[type='text']").keyup(e => {
      var val = $(e.target).val()
      val !== this.preText && this.search(val)
    })
  }

  setValue (name, value) {
    this.btn__select.children("input[type='text']").val(value)
    this.btn__select.children("input[type='hidden']").val(name)
  }

  buildData () {
    var data = {}
    var items = this.btn__select.find("li")
    items.each(function(){
      data[$(this).attr("name")] = $(this).text()
    })
    this.data = data
  }

  buildDom (data) {
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
      this.buildDom(data)
    }else{
      this.buildDom(this.data)
    }
  }

}