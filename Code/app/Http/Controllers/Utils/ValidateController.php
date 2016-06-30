<?php

namespace App\Http\Controllers\Utils;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
use App\Enums\StatusCodeEnum;
use App\User;

class ValidateController extends Controller
{
    /**
     * 检查手机是否已经被注册
     * @return array
     */
    public function postPhoneUnique(Request $request)
    {
        $mobile = $request->input('mobile');

        $find = User::where('mobile', $mobile)->first();

        if($find) {
            return $this->jsonReturn(
                StatusCodeEnum::ERROR_CODE,
                '该手机号已被注册'
            );
        } else {
            return $this->jsonReturn(
                StatusCodeEnum::SUCCESS_CODE,
                '该手机可以注册'
            );
        }
    }

    //
}
