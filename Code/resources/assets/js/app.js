import $ from 'jquery'
import CommonModule from './common/module'
import AuthModule from './auth/module'
import UserModule from './users/module'

window.$ = $

var moduleMap = {}

new CommonModule(moduleMap)
new AuthModule(moduleMap)
new UserModule(moduleMap)

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
