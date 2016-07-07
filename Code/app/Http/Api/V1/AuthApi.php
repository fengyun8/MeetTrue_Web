<?php

namespace App\Http\Api\V1;

use App\Http\Requests\ApiRequest;
use Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Enums\StatusCodeEnum;

class AuthApi extends BaseApi
{
    use AuthenticatesUsers;

    /**
     * 用户登录 auth.login
     * @param  ApiRequest $request 
     * @return Response
     */
    public function login(ApiRequest $request)
    {
        // 一直保持登录状态
        $request->inject('remember', 1);

        $credentials = $request->input('credential');
        $password = $request->input('password');
        $remember = $request->input('remember');

        $this->validateForApi($request, [
            'credential' => 'required',
            'password' => 'required|min:6|max:12'
        ]);

        // 尝试登录,成功则成为已登录状态
        $result = Auth::attempt(['email' => $credentials, 'password' => $password], $remember) || Auth::attempt(['mobile' => $credentials, 'password' => $password], $remember);
        
        if(!$result) {
            return $this->jsonReturn(StatusCodeEnum::ERROR_CODE, '账户名和密码不匹配');
        } 
        
        $user = Auth::user();
        return $this->jsonReturn(StatusCodeEnum::SUCCESS_CODE, '登陆成功', compact('user'));
    }

    /**
     * 退出登录  auth.logout
     */
    public function logout()
    {
        Auth::logout();
    }
}