import $ from 'jquery'
import Common from './common/common'
import Auth from './auth/auth'

window.$ = $

var moduleMap = {}

new Common(moduleMap)
new Auth(moduleMap)

/**
 * 模块启动方法
 *
 * 模块于上方import进来
 * 实例化（new）后放到moduleMap里
 *
 * 页面加载完成后会获取body标签里data-module里的数据逐个执行相应模块的init方法。
 */
$(function () {
  var moduleNameList = $('body').data('module').split(' ')
  moduleNameList.forEach(function(moduleName){
    !!moduleMap[moduleName] && moduleMap[moduleName].init()
  })
})
