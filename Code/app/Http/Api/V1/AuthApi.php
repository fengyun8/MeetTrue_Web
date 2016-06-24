<?php

namespace App\Http\Api\V1;

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Requests\ApiRequest;
use App\User;
use App\UserToken;
use Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class AuthApi extends BaseApi
{
    use AuthenticatesUsers;

    public function login(ApiRequest $apiRequest)
    {
//        dd($apiRequest->input('key'));
//        dd('auth.login');

        return $this->jsonReturn(200, '登陆成功');
    }
}