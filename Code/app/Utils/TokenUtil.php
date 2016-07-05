<?php
namespace App\Utils;

use Illuminate\Support\Str;

/**
 * 自己封装的Token类
 *
 * @package App\Utils
 */
class TokenUtil
{
    /**
     * Create a new token.
     *
     * @return string
     */
    public static function createToken()
    {
        return md5(Str::random(40));
    }
}