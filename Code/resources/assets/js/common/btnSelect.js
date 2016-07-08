// 下拉选择按钮 btnSelect
export default class BtnSelect {
  constructor () {
    this.btnSelectClass = ".btn__select"
    this.btnSelectList = {}
  }
  init () {
    var _this = this
    $(this.btnSelectClass).each(function(){
      var name = $(this).children('input[type="hidden"]').attr("name");
      var btnSelect = new BtnSelectClass($(this))
      _this.btnSelectList[name] = btnSelect
      btnSelect.init()
    })
  }

  getList () {
    return this.btnSelectList
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
 * 初始化：
    var btnSelect = new btnSelectClass(jQueryDomObject,data)
    btnSelect.init()
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
export class BtnSelectClass {
  constructor (element, data = null){
    this.btn__select = element
    this.data = data
    this.preText = ""
    this.name = undefined
    this.btnSelectRelation = null
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
      typeof _this.btnSelectRelation === "function" && _this.btnSelectRelation(_this.name,$(this).attr("name"))
    })
    // 监听输入动作，触发搜索功能
    this.btn__select.children("input[type='text']").keyup(e => {
      var val = $(e.target).val()
      val !== this.preText && this.search(val)
    })
    // 监听失去焦点动作，纠正输入
    this.btn__select.find("input[type='text']").focusout(e => {
      var nameEle = this.btn__select.find("input[type='hidden']")
      var name = nameEle.val()
      var value = $(e.target).val()
      if(name == ""){
        $(e.target).val('')
        this.reBuildDom(this.data)
        return false
      }
      $(e.target).val(this.data[name])
    })
    this.setName()
  }

  setValue (name, value) {
    this.btn__select.children("input[type='text']").val(value)
    this.btn__select.children("input[type='hidden']").val(name)
  }

  setName () {
    this.name = this.btn__select.children('input[type="hidden"]').attr("name")
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
        (v.indexOf(val) > -1) && (data[k] = v);
        (v == val) && (this.setValue(k,v));
      })
      this.reBuildDom(data)
    }else{
      this.reBuildDom(this.data)
    }
  }
}

/*["province","city"]*/
/**
 * btnSelect关联器
 * 在btnSelect初始化之后 才能 将关联器调用初始化
 *
 * 在实例化关联器是传入与关联按钮的name数组，按关联顺序排序
 * 如下：province的下一级是city
 * 
 * 关于初始化的板栗：
    var btnSelectRelations = new btnSelectRelation(["province","city"])
    btnSelectRelations.init()
 *
 * 设置数据:
    window.btnSelectList.province.setSource({
      zj: "浙江省",
      hn: "湖南省",
      sc: "四川省"
    })

    window.btnSelectList.city.setSource({
      zj: {
        hz:"杭州市",
        sx:"绍兴市",
        jh:"金华市"
      },
      hn: {
        cs:"长沙市",
        yy:"岳阳市",
        cd:"常德市"
      },
      sc: {
        cd:"成都市",
        my:"绵阳市",
        dy:"德阳市"
      }
    })
 * 
 */
export class BtnSelectRelation {
  constructor (relationType, btnSelectList) {
    this.relationType = relationType
    this.relationData = []
    this.set = (childName, data) => {
      var index = this.getChildIndex(childName)
      this.relationData[index] = data
      index == 0 && this.setChildData(index, data)
    }
    this.btnSelectList = btnSelectList
  }
  init () {
    $.each(this.relationType,(k, v) => {
      this.btnSelectList[v].setSource = data => {
        var name = v
        this.set(name,data)
      }
      this.btnSelectList[v].btnSelectRelation = (btnName,key) => {
        var index = this.getChildIndex(btnName) + 1
        index > 0 && index < this.relationData.length && this.filter(index, key)
      }
    })
  }

  getChildIndex (childName) {
    return this.relationType.indexOf(childName)
  }

  filter (index, key) {
    this.setChildData(index, this.relationData[index][key])
  }

  setChildData (index, data) {
    this.btnSelectList[this.relationType[index]].set(data)
  }
}