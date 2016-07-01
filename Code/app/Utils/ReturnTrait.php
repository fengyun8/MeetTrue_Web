<?php

namespace App\Utils;

use Illuminate\Contracts\Validation\Validator;
use App\Enums\StatusCodeEnum;
use Illuminate\Support\Arr;

/**
 * Return Trait
 */
trait ReturnTrait
{

    /**
     * json 格式返回结果
     * @param  [type] $code [description]
     * @param  [type] $msg  [description]
     * @param  [type] $data  [description]
     * @return [type]       [description]
     */
    public function jsonReturn($code, $msg = null, $data = null)
    {
        // Handle Success Msg
        if ($msg == null && $code == StatusCodeEnum::SUCCESS_CODE) {
            $msg = $this->sysMessage(StatusCodeEnum::SUCCESS_CODE);
        }

        return response()->json([
            'status_code' => $code,
            'msg' => $msg,
            'data' => $data
        ]);
    }

    /**
     * Format Validator Errors
     * @param  Validator $validator [description]
     * @return [type]               [description]
     */
    public function formatErrors(Validator $validator)
    {
        return $validator->errors();
    }

    /**
     * Get Sys Message
     * @param null $code
     * @return mixed
     */
    public function sysMessage($code = null)
    {
        $stat = [
            // 系统状态码
            StatusCodeEnum::SUCCESS_CODE => '操作成功',
            StatusCodeEnum::NO_PERMISSION_CODE => '权限不足',

            // 自定义状态码
        ];

        return Arr::get($stat, $code, '');
    }
}