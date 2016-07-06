<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    /**
     *  该控制器的很多方法都只有登录后的用户才能访问
     *  使用auth中间件，过滤掉未登录用户
     */
    public function __construct()
    {
        $this->middleware('auth']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view('users.show');
    }

    /**
     * 检验用户输入的当前密码和数据库中的密码是否一致
     * @param  Request $request 
     * @return [type]           [description]
     */
    public function postVerifyCurrentPassword(Request $request)
    {
        $requestPassword = bcrypt($request->input('current_password'));
        $databasePassword = Auth::user()->password;

        if($requestPassword == $databasePassword) {
            return $this->jsonReturn(
                StatusCodeEnum::ERROR_CODE, 
                ['password' => '输入的当前密码不正确']
            );
        }

        return $this->jsonReturn(
            StatusCodeEnum::SUCESS_CODE, 
            ['password' => '当前密码验证成功']
        );
    }
}
