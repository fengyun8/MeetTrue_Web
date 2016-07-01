<?php

namespace App\Http\Controllers\Utils;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
use App\Enums\StatusCodeEnum;
use App\User;
use App\Utils\PictureValidateCode;

class ValidateController extends Controller
{
    /**
     * 检查手机是否已经被注册
     * @return array
     */
    public function phoneUnique(Request $request)
    {
        $mobile = $request->input('mobile');

        $find = User::where('mobile', $mobile)->first();

        if($find) {
            return $this->jsonReturn(
                StatusCodeEnum::ERROR_CODE,
                '该手机号已注册'
            );
        } else {
            return $this->jsonReturn(
                StatusCodeEnum::SUCCESS_CODE,
                '该手机可以注册'
            );
        }
    }

    /**
     * 生成图片验证码
     */
    public function createPicCode(Request $request)
    {
        $pictureValidateCode = new PictureValidateCode;
        $request->session()->put('picture_validate_code', $pictureValidateCode->getCode());
        return $pictureValidateCode->doimg();
    }

    /**
     * 验证手机是否注册，验证输入的验证码是否正确
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function verifyPicCode(Request $request)
    {
        $mobile = $request->input('mobile');
        $pictureValidateCode = $request->input('pic_code', '');
        $pictureValidateCodeSession = $request->session()->get('picture_validate_code');
        $haveMobile = User::where('mobile', $mobile)->first();
        $isRightMobile = preg_match('/^(\+?0?86\-?)?((13\d|14[57]|15[^4,\D]|17[678]|18\d)\d{8}|170[059]\d{7})$/', $mobile);

        if($mobile == '') {
            return $this->jsonReturn(StatusCodeEnum::ERROR_CODE, ['mobile' => '手机号不能为空']);
        }

        if($pictureValidateCode == '') {
            return $this->jsonReturn(StatusCodeEnum::ERROR_CODE, ['pic_code' => '验证码不能为空']);
        }

        if(! $isRightMobile) {
            return $this->jsonReturn(StatusCodeEnum::ERROR_CODE, ['mobile' => '手机号格式不正确']);
        }

        if($haveMobile == null) {
            return $this->jsonReturn(StatusCodeEnum::ERROR_CODE, ['mobile' => '该手机未注册']);
        } elseif ($pictureValidateCode != $pictureValidateCodeSession) {
            return $this->jsonReturn(StatusCodeEnum::ERROR_CODE,['pic_code' => '验证码有误']);
        } else {
            return $this->jsonReturn(StatusCodeEnum::SUCCESS_CODE,'success');
        }
    }
}
