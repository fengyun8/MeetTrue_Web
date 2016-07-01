import $ from 'jquery'
import Password from './auth/password'
import Login from './auth/login'
import Register from './auth/register'

window.$ = $;

var moduleMap = {};
moduleMap.password = new Password();
moduleMap.login = new Login();
moduleMap.register = new Register();

/**
 * 模块启动方法
 *
 * 模块于上方import进来
 * 实例化（new）后放到moduleMap里
 *
 * 页面加载完成后会获取body标签里data-module里的数据逐个执行相应模块的init方法。
 */
$(function () {
  var moduleNameList = $('body').data('module').split(' ');
  moduleNameList.forEach(function(moduleName){
    !!moduleMap[moduleName] && moduleMap[moduleName].init();
  })
})
