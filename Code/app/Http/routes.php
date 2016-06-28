<?php

use \App\Services\UploadService;


// 注册路由...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

// 登录路由...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Api 部分
Route::post('api', 'APIController@gateway');
//文件上传接口
Route::controller('file', 'File\FileController');

//后台 admin
Route::group(['namespace' => 'Admin'], function()
// Route::group(['namespace' => 'Admin', 'middleware' => 'auth'], function()
{
  Route::get('/admin', 'AdminController@index');
});

Route::get('/', 'PagesController@index');