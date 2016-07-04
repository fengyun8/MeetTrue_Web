<?php

Route::controller('/zjp', 'ZjpTestController');

// 注册路由...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

// 登录路由...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// 与发送短信相关
Route::get('sms/info', 'Utils\SmsController@getInfo');
Route::post('sms/send-code', 'Utils\SmsController@postSendCode');
Route::post('sms/verify-code', 'Utils\SmsController@postVerifyCode');


// 与验证相关:1.验证手机唯一，2:生成图片验证码；3：图片验证码验证
Route::post('verify/phone-unique', 'Utils\ValidateController@phoneUnique');
Route::get('pic/create-code', 'Utils\ValidateController@createPicCode');
Route::post('pic/verify-code', 'Utils\ValidateController@verifyPicCode');

// 忘记密码
Route::get('auth/password', 'Auth\AuthController@getPassword');
Route::get('auth/reset-success', 'Auth\AuthController@getResetSuccess');

// Api 部分
Route::post('api', 'APIController@gateway');
//文件上传接口
Route::controller('file', 'File\FileController');

//后台 admin
Route::group(['namespace' => 'Admin', 'middleware' => 'auth'], function()
{
  Route::get('/admin', 'AdminController@index');
  Route::get('/admin/banner', 'AdminController@index');
  Route::get('/admin/activity', 'AdminController@getActivity');
});

Route::get('/', 'PagesController@index');
// test route
Route::get('test', 'PagesController@test');


// Password Route
Route::group(['prefix' => 'password', 'namespace' => 'Auth'], function () {
    // 密码重置链接的路由...
    Route::get('email', 'PasswordController@getEmail');
    Route::post('email', 'PasswordController@postEmail');

    // 密码重置的路由...
    Route::get('reset/{token}', 'PasswordController@getReset');
    Route::post('reset', 'PasswordController@postResetByEmail');

    //手机重置密码
    Route::post('reset-by-phone', 'PasswordController@postResetByPhone');
});
