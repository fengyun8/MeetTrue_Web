<?php

namespace App\Utils;

use Illuminate\Contracts\Validation\Validator;

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
    public function jsonReturn($code, $msg = NULL, $data = NULL)
    {
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
        return $validator->errors()->all();
    }
}