import BtnSelect from './../common/btnSelect'
import {BtnSelectRelation} from './../common/btnSelect'

export default class {
  constructor () {

  }

  init () {
    var btnSelect = new BtnSelect()
    btnSelect.init()
    var btnSelectList = btnSelect.getList()
    new BtnSelectRelation(["province","city"],btnSelectList).init()


    btnSelectList.province.setSource({
      zj: "浙江省",
      hn: "湖南省",
      sc: "四川省"
    })

    btnSelectList.city.setSource({
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
  }
}